<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $email
 * @property string $token
 * @property integer $created_at
 * @property integer $updated_at
 */
class Link extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email']
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    public function generateToken()
    {
        $this->token = Yii::$app->security->generateRandomString();
    }

    public static function findByToken($token)
    {
       return static::findOne([
           'token' => $token
       ]);
    }
    public static function deleteLinksByToken($token)
    {
        return static::deleteAll([
            'token' => $token
        ]);
    }
}