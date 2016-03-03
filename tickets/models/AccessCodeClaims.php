<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "access_code_claims".
 *
 * @property integer $access_code_id
 * @property integer $user_id
 * @property integer $quantity_used
 */
class AccessCodeClaims extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'access_code_claims';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['access_code_id', 'user_id', 'quantity_used'], 'required'],
            [['access_code_id', 'user_id', 'quantity_used'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'access_code_id' => Yii::t('app', 'Access Code ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'quantity_used' => Yii::t('app', 'Quantity Used'),
        ];
    }
    
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getAccessCode() {
        return $this->hasOne(AccessCode::className(), ['id', 'access_code_id']);
    }
}
