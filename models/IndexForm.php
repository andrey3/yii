<?php

namespace app\models;

use Yii;
use yii\base\Model;

class IndexForm extends Model
{
    public $email;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'safe']
        ];
    }

    public function generateLink()
    {
        $link = new Link();

        $link->email = $this->email;
        $link->generateToken();

        return $link->save(false) && empty($this->getErrors()) ? $link : null;
    }

    public function sendMail($url, $email)
    {
        return Yii::$app->mailer->compose('mail', ['url' => $url])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setTo($email)
                ->setSubject('Message subject')
                ->send();
    }
}