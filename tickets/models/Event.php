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
 * @property string $location_id
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
            ['id', 'default'],
            [['owner_id', 'name', 'slug', 'start_time', 'end_time', 'description', 'summary', 'location_id'], 'required'],
            [['owner_id', 'location_id'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['slug'], 'string', 'max' => 100],
            [['summary'], 'string', 'max' => 500],
            ['end_time', function($attribute, $params) {
                    if ($this->end_time <= $this->start_time) {
                        $this->addError($attribute, Yii::t('app', 'End time must be later than start time'));
                    }
                }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'Event ID'),
            'owner_id' => Yii::t('app', 'Owner Organisation'),
            'name' => Yii::t('app', 'Name'),
            'slug' => Yii::t('app', 'URL Slug'),
            'start_time' => Yii::t('app', 'Start time'),
            'end_time' => Yii::t('app', 'End time'),
            'description' => Yii::t('app', 'Description'),
            'summary' => Yii::t('app', 'Summary'),
            'location_id' => Yii::t('app', 'Location'),
        ];
    }

    public function getOwner() {
        return $this->hasOne(Organisation::className(), ['id' => 'owner_id']);
    }

    public function getTicketGroups() {
        return $this->hasMany(TicketGroup::className(), ['event_id' => 'id']);
    }

    public function getLocation() {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    public static function getList() {
        $list = [];
        $items = self::find()->all();
        foreach ($items as $i) {
            $list[$i->id] = $i->name;
        }
        return $list;
    }

}
