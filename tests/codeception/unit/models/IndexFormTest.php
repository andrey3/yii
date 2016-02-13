<?php

namespace tests\codeception\unit\models;

use Yii;
use yii\codeception\TestCase;
use app\models\IndexForm;

class IndexFormTest extends TestCase
{
    public function testValidate()
    {
        $email = new IndexForm();
        $this->assertFalse($email->validate(['email']));
    }
}
