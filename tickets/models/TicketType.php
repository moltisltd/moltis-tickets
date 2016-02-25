<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticket_type".
 *
 * @property integer $id
 * @property string $name
 */
class TicketType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Ticket Type ID',
            'name' => 'Ticket Type Name',
        ];
    }
    public function getTickets() {
        return $this->hasMany(Ticket::className(), ['type_id' => 'id']);
    }
}
