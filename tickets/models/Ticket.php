<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticket".
 *
 * @property integer $id
 * @property integer $group_id
 * @property integer $type_id
 * @property string $name
 * @property string $ticket_price
 * @property string $ticket_fee
 * @property integer $fee_included
 * @property integer $ticket_limit
 * @property string $description
 * @property string $sell_from
 * @property string $sell_until
 * @property integer $requires_access_code
 */
class Ticket extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ticket';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['group_id', 'type_id', 'name', 'ticket_price', 'ticket_fee', 'fee_included', 'ticket_limit', 'description', 'sell_from', 'sell_until', 'requires_access_code'], 'required'],
            [['group_id', 'type_id', 'fee_included', 'ticket_limit', 'requires_access_code'], 'integer'],
            [['ticket_price', 'ticket_fee'], 'number'],
            [['sell_from', 'sell_until'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
            ['sell_until', function($attribute, $params) {
                    if ($this->sell_until <= $this->sell_from) {
                        $this->addError($attribute, Yii::t('app', 'Sell until time must be later than sell from time'));
                    }
                }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'Ticket ID'),
            'group_id' => Yii::t('app', 'Ticket Group ID'),
            'type_id' => Yii::t('app', 'Ticket Type ID'),
            'name' => Yii::t('app', 'Ticket Name'),
            'ticket_price' => Yii::t('app', 'Ticket price'),
            'ticket_fee' => Yii::t('app', 'Ticket Fee'),
            'fee_included' => Yii::t('app', 'Is fee included in price?'),
            'ticket_limit' => Yii::t('app', 'Tickets available'),
            'description' => Yii::t('app', 'Ticket Description'),
            'sell_from' => Yii::t('app', 'Start selling from'),
            'sell_until' => Yii::t('app', 'Stop selling at'),
            'requires_access_code' => Yii::t('app', 'Requires Access Code'),
        ];
    }

    public function getGroup() {
        return $this->hasOne(TicketGroup::className(), ['id' => 'group_id']);
    }

    public function getType() {
        return $this->hasOne(TicketType::className(), ['id' => 'type_id']);
    }

    public function getCartItems() {
        return $this->hasMany(CartItems::className(), ['ticket_id' => 'id']);
    }

    public function getAccessCodes() {
        return $this->hasMany(AccessCode::className(), ['ticket_id' => 'id']);
    }

    /**
     * return boolean
     */
    public function isAvailable() {
date_default_timezone_set('Europe/London');
        $now = date('Y-m-d H:i:s');
date_default_timezone_set('UTC');
        if ($this->sell_from <= $now && $this->sell_until >= $now) {
            $group = $this->group;
            if ($group->ticket_limit > 0 && $group->getSoldQuantity() >= $group->ticket_limit) { // group ticket limit
                return false;
            } else if ($this->ticket_limit > 0 && $this->getSoldQuantity() >= $this->ticket_limit) { // ticket limit
                return false;
            }
        } else {
            return false;
        }
        return true;
    }

    public function getSoldQuantity() {
        $cartItems = $this->getCartItems()->all();
        $quantitySold = 0;
        foreach ($cartItems as $item) {
            $cart = $item->getCart()->one();
            if ($cart->status == Cart::CART_SOLD) {
                $quantitySold += $item->quantity;
            }
        }
        return $quantitySold;
    }

    public function getAvailableQuantity() {
        $group = $this->group;
        $ticketAvailable = $this->ticket_limit - $this->getSoldQuantity();
        if ($group->ticket_limit) {
            $groupAvailable = $group->getAvailableQuantity();
            if ($groupAvailable < $ticketAvailable || !$this->ticket_limit) {
                return $groupAvailable;
            }
        }
        if ($this->ticket_limit) {
            return $ticketAvailable;
        }
        return false;
    }

}
