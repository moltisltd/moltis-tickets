<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticket_group".
 *
 * @property integer $id
 * @property integer $event_id
 * @property string $name
 * @property integer $ticket_limit
 */
class TicketGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'name', 'ticket_limit'], 'required'],
            [['event_id', 'ticket_limit'], 'integer'],
            [['name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Ticket Group ID',
            'event_id' => 'Event ID',
            'name' => 'Ticket Group Name',
            'ticket_limit' => 'Tickets Available',
        ];
    }
    
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }
    
    public function getTickets() {
        return $this->hasMany(Ticket::className(), ['group_id' => 'id']);
    }
}
