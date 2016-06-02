<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $session_id
 * @property string $created
 * @property string $updated
 * @property integer $status
 * @property string $charge_id
 * @property string $charge_details
 */
class Cart extends \yii\db\ActiveRecord {

    const CART_PENDING = 0x000;
    const CART_SOLD = 0x001;
    const CART_REFUNDED = 0x002;

    public $quantity = 0;
    public $subtotal = 0;
    public $total = 0;
    public $fees = 0;
    public $stripe_fee = 0;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cart';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['customer_id', 'session_id', 'created', 'status'], 'required'],
            [['customer_id', 'status'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['session_id', 'charge_id'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'Cart ID'),
            'customer_id' => Yii::t('app', 'Customer User ID'),
            'session_id' => Yii::t('app', 'Session ID'),
            'created' => Yii::t('app', 'Time created'),
            'updated' => Yii::t('app', 'Last updated'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public static function getCurrentCart() {
        if (($cart = self::findOne(['customer_id' => \Yii::$app->user->identity->id, 'status' => self::CART_PENDING])) !== null) {
            $cart->cleanUp();
            return $cart;
        }
        $cart = new Cart();
        $cart->customer_id = \Yii::$app->user->identity->id;
        $cart->session_id = session_id();
        $cart->created = date('Y-m-d H:i:s');
        $cart->status = self::CART_PENDING;
        $cart->save();
        return $cart;
    }

    public function addItem($id) {
        if ($this->status == self::CART_PENDING) {
            if (($cart_item = CartItems::findOne(['cart_id' => $this->id, 'ticket_id' => $id])) === null) {
                $cart_item = new CartItems();
                $cart_item->quantity = 0;
            }
            $cart_item->cart_id = $this->id;
            $cart_item->ticket_id = $id;
            $cart_item->quantity++;
            $cart_item->save();
            $this->updateCart();
        }
    }

    public function removeItem($id) {
        if ($this->status == self::CART_PENDING) {
            if (($cart_item = CartItems::findOne(['cart_id' => $this->id, 'ticket_id' => $id]))) {
                $cart_item->delete();
                $this->updateCart();
            }
        }
    }

    public function reduceItem($id) {
        if ($this->status == self::CART_PENDING) {
            if (($cart_item = CartItems::findOne(['cart_id' => $this->id, 'ticket_id' => $id])) === null) {
                return;
            }
            $cart_item->quantity--;
            $cart_item->save();
            $this->updateCart();
            if ($cart_item->quantity == 0) {
                $this->removeItem($id);
            }
        }
    }

    public function updateItem($id, $quantity) {
        if ($this->status == self::CART_PENDING) {
            if (($cart_item = CartItems::findOne(['cart_id' => $this->id, 'ticket_id' => $id])) === null) {
                return;
            }
            $cart_item->quantity = $quantity;
            $cart_item->save();
            $this->updateCart();
            if ($cart_item->quantity == 0) {
                $this->removeItem($id);
            }
        }
    }

    public function updateCart() {
        $this->updated = date('Y-m-d H:i:s');
        $this->save();
    }

    public function getItems() {
        return $this->hasMany(CartItems::className(), ['cart_id' => 'id']);
    }

    public function getCustomer() {
        return $this->hasOne(User::className(), ['id' => 'customer_id']);
    }

    public function processCart() {
        $this->cleanUp();
        $this->quantity = 0;
        $this->subtotal = 0;
        $this->fees = 0;
        $this->stripe_fee = 0;
        foreach ($this->items as $item) {
            $this->quantity += $item->quantity;
            $this->subtotal += $item->quantity * $item->ticket->ticket_price;
            $this->fees += $item->quantity * $item->ticket->ticket_fee;
        }
        if ($this->subtotal > 0) {
            $this->stripe_fee = round(0.015 * $this->subtotal + 0.2, 2);
            $this->fees += $this->stripe_fee;
        }
        $this->total = $this->subtotal + $this->stripe_fee;
    }

    public function displayStatus() {
        switch ($this->status) {
            default:
            case self::CART_PENDING: return Yii::t('app', 'Pending');
            case self::CART_SOLD: return Yii::t('app', 'Completed');
            case self::CART_REFUNDED: return Yii::t('app', 'Refunded');
        }
    }

    public function cleanUp() {
        $items = $this->getItems()->all();
        $items_removed = false;
        foreach ($items as $item) {
            $ticket = Ticket::findOne($item->ticket_id);
            if (!$ticket->isAvailable()) {
                $this->removeItem($item->ticket_id);
                $items_removed = true;
            } else if ($ticket->getAvailableQuantity() !== false && $item->quantity > $ticket->getAvailableQuantity()) {
                $this->updateItem($item->ticket_id, $ticket->getAvailableQuantity());
                $items_removed = true;
            }
        }
        if ($items_removed) {
            $session = new Session();
            $session->addError(Yii::t('app', 'Unavailable tickets removed'));
        }
    }

}
