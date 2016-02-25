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
            [['group_id', 'type_id', 'name', 'ticket_price', 'ticket_fee', 'fee_included', 'ticket_limit', 'description', 'sell_from', 'sell_until'], 'required'],
            [['group_id', 'type_id', 'fee_included', 'ticket_limit'], 'integer'],
            [['ticket_price', 'ticket_fee'], 'number'],
            [['sell_from', 'sell_until'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'Ticket ID',
            'group_id' => 'Ticket Group ID',
            'type_id' => 'Ticket Type ID',
            'name' => 'Ticket Name',
            'ticket_price' => 'Ticket price',
            'ticket_fee' => 'Ticket Fee',
            'fee_included' => 'Is fee included in price?',
            'ticket_limit' => 'Tickets available',
            'description' => 'Ticket Description',
            'sell_from' => 'Start selling from',
            'sell_until' => 'Stop selling at',
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
}
