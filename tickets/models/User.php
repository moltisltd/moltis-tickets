<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $customer_token
 * @property integer $admin
 * @property string $access_token
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 100, 'min' => 8],
            [['email'], 'unique'],
            ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'User ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'customer_token' => 'Stripe Customer Token',
            'admin' => 'Admin flag',
            'access_token' => 'Security Access Token',
        ];
    }
	
    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
	
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->access_token;
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
		return \Yii::$app->security->validatePassword($password, $this->password);
    }
	
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }
            if ($this->isNewRecord) {
                $this->access_token = \Yii::$app->security->generateRandomString();
				$this->password = \Yii::$app->security->generatePasswordHash($this->password);
            } else if (!preg_match('/^\$2[axy]\$(\d\d)\$[\.\/0-9A-Za-z]{22}/', $this->password, $matches) || $matches[1] < 4 || $matches[1] > 30) {
				$this->password = \Yii::$app->security->generatePasswordHash($this->password);
			}
            return true;
        }
        return false;
    }
    
    public function getMemberships() {
        return $this->hasMany(OrganisationMembers::className(), ['user_id' => 'id']);
    }
    public function getOrganisations() {
        $organisations = [];
        foreach ($this->memberships as $membership) {
            $organisations[] = $membership->organisation;
        }
        return $organisations;
    }
    public function getCarts() {
        return $this->hasMany(Cart::className(), ['customer_id', 'id']);
    }
}
