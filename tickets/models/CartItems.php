<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cart_items".
 *
 * @property integer $cart_id
 * @property integer $ticket_id
 * @property integer $quantity
 */
class CartItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cart_id', 'ticket_id', 'quantity'], 'required'],
            [['cart_id', 'ticket_id', 'quantity'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cart_id' => 'Cart ID',
            'ticket_id' => 'Ticket ID',
            'quantity' => 'Quantity',
        ];
    }
    
    public function getCart() {
        return $this->hasOne(Cart::className(), ['id' => 'cart_id']);
    }
    
    public function getTicket() {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }
}
