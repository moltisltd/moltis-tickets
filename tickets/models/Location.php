<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $postcode
 * @property string $country
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'postcode', 'country'], 'required'],
            [['id'], 'integer'],
            ['id', 'default'],
            [['address'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['postcode'], 'string', 'max' => 10],
            [['country'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'postcode' => Yii::t('app', 'Postcode'),
            'country' => Yii::t('app', 'Country Code'),
        ];
    }
    
    public static function getList() {
        $list = [];
        $items = self::find()->all();
        foreach ($items as $i) {
            $list[$i->id] = $i->name;
        }
        return $list;
    }
    
    public static function getEvents() {
        return $this->hasMany(Event::className(), ['location_id', 'id']);
    }
}
