<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organisation".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $email
 * @property string $summary
 * @property string $stripe_access_token
 * @property string $stripe_user_id
 */
class Organisation extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'organisation';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'url', 'email', 'summary'], 'required'],
            [['summary'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['url', 'email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'Organisation ID',
            'name' => 'Organisation Name',
            'url' => 'Organisation URL',
            'email' => 'Organisation Contact Email',
            'summary' => 'Organisation Summary',
        ];
    }

    public function getEvents() {
        return $this->hasMany(Event::className(), ['owner_id' => 'id']);
    }

    public function getMembers() {
        return $this->hasMany(OrganisationMembers::className(), ['organisation_id' => 'id']);
    }
}
