<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use \yii\web\IdentityInterface;
use \yii\db\ActiveRecord;
/**
 * This is the model class for table "user".
 *
 * @property string $username
 * @property string $password
 */
class UserRecord extends ActiveRecord implements IdentityInterface
{

    public $id;
    public $auth_key;
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
            [['username', 'password'], 'required'],
            [['username','auth_key'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 80]
        ];
    }


    public function beforeSave($insert)
    {
        $return = parent::beforeSave($insert);

        if($this->getIsNewRecord()){
            $this->auth_key = Yii::$app -> security -> generateRandomKey($length = 255);
        }

        if ($this->isAttributeChanged('password')) {
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        }
        return $return;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this -> getAuthKey() === $authKey;
    }

    public static function findIdentityByAccessToken($token, $type =null)
    {
        throw new NotSupportedException('You can only login by username or password for now.');
    }
}
