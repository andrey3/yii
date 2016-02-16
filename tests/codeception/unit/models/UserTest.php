<?php

namespace tests\codeception\unit\models;


use Yii;
use app\models\User;
use app\models\LoginForm;


class IndexFormTest extends \Codeception\TestCase\Test
{

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testRegUser()
    {
        $user = new User();

        $user->email = 'test@test.ru';
        $user->name = 'test';
        $user->setPassword('password');
        $user->generateAuthKey();

        $this->assertTrue($user->validate());
        $this->assertTrue($user->save());

        $this->tester->seeInDatabase('users', ['email' => 'test@test.ru', 'name' => 'test']);
    }
}