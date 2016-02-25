<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property integer $owner_id
 * @property string $name
 * @property string $slug
 * @property string $start_time
 * @property string $end_time
 * @property string $description
 * @property string $summary
 */
class Event extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['owner_id', 'name', 'slug', 'start_time', 'end_time', 'description', 'summary'], 'required'],
            [['owner_id'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['slug'], 'string', 'max' => 100],
            [['summary'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'Event ID',
            'owner_id' => 'Owner Organisation ID',
            'name' => 'Event Name',
            'slug' => 'Event URL Slug',
            'start_time' => 'Start time',
            'end_time' => 'End time',
            'description' => 'Description',
            'summary' => 'Summary',
        ];
    }

    public function getOwner() {
        return $this->hasOne(Organisation::className(), ['id' => 'owner_id']);
    }
    
    public function getTicketGroups() {
        return $this->hasMany(TicketGroup::className(), ['event_id' => 'id']);
    }
}
