<?php

namespace tests\codeception\unit\models;


use Yii;
use app\models\IndexForm;
use app\models\Link;


class LinkTest extends \Codeception\TestCase\Test
{
    use \Codeception\Specify;

    /**
     * @var \UnitTester
     */
    protected $tester;
    private $model;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testValidateEmail()
    {
        $this->model = new IndexForm();

        $this->specify("email is required", function() {
            $this->model->email = null;
            $this->assertFalse($this->model->validate());
        });

        $this->specify("email is email", function() {
            $this->model->email = "test";
            $this->assertFalse($this->model->validate());
        });

        $this->specify("email is ok", function() {
            $this->model->email = "test@test.ru";
            $this->assertTrue($this->model->validate());
        });

    }

    public function testSaveLink()
    {
        $link = new Link();

        $link->email = "test@test.ru";
        $link->generateToken();
        $token = $link->token;

        $this->assertTrue($link->save());

        $this->tester->seeInDatabase('links', ['email' => 'test@test.ru', 'token' => $token]);

    }

}