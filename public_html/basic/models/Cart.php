<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $session_id
 * @property string $created
 * @property string $updated
 * @property integer $status
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'session_id', 'created', 'status'], 'required'],
            [['customer_id', 'status'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Cart ID',
            'customer_id' => 'Customer User ID',
            'session_id' => 'Session ID',
            'created' => 'Time created',
            'updated' => 'Time last updated',
            'status' => 'Status',
        ];
    }
}
