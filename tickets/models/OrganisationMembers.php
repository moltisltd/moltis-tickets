<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organisation_members".
 *
 * @property integer $organisation_id
 * @property integer $user_id
 * @property integer $founder
 */
class OrganisationMembers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organisation_members';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organisation_id', 'user_id', 'founder'], 'required'],
            [['organisation_id', 'user_id', 'founder'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'organisation_id' => 'Organisation ID',
            'user_id' => 'User ID',
            'founder' => 'Founder',
        ];
    }
    
    public function getOrganisation()
    {
        return $this->hasOne(Organisation::className(), ['id' => 'organisation_id']);
    }
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
