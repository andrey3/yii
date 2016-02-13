<?php

namespace app\models;


use Yii;
use yii\base\Model;


class RegForm extends Model
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'filter', 'filter' => 'trim'],
            [['name', 'email', 'password'], 'required'],
            ['email', 'email'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 6, 'max' => 255],
            ['email', 'unique',
                'targetClass' => User::className(),
                'message' => 'this email is already busy'],
            [['name', 'email', 'password'], 'safe']
        ];
    }

    public function reg()
    {
        $user = new User();

        $user->name = $this->name;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save(false) && empty($this->getErrors()) ? $user : null;
    }
}