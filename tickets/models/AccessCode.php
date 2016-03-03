<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "access_code".
 *
 * @property integer $id
 * @property string $access_code
 * @property integer $organisation_id
 * @property integer $ticket_id
 * @property integer $user_limit
 * @property integer $claim_limit
 */
class AccessCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'access_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['access_code', 'ticket_id', 'user_limit', 'claim_limit'], 'required'],
            [['ticket_id', 'user_limit', 'claim_limit'], 'integer'],
            [['access_code'], 'string', 'max' => 50],
            [['access_code', 'ticket_id'], 'unique', 'targetAttribute' => ['access_code', 'ticket_id'], 'message' => 'The combination of Access Code and Ticket ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Access Code ID'),
            'access_code' => Yii::t('app', 'Access Code'),
            'ticket_id' => Yii::t('app', 'Ticket ID'),
            'user_limit' => Yii::t('app', 'User Claim Limit'),
            'claim_limit' => Yii::t('app', 'Total Claim Limit'),
        ];
    }
    
    public function getTicket() {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }
    
    public function getClaims() {
        return $this->hasMany(AccessCodeClaims::className(), ['access_code_id' => 'id']);
    }
}
