<?php

use yii\db\Schema;
use yii\db\Migration;

class m160210_211122_create_users_table extends Migration
{
    public function up()
    {
        $this->createTable('users',
            [
                'id'=>Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING.' NOT NULL',
                'email' => Schema::TYPE_STRING.' NOT NULL',
                'password_hash' => Schema::TYPE_STRING.' NOT NULL',
                'auth_key' => Schema::TYPE_STRING.'(32) NOT NULL',
                'created_at' => Schema::TYPE_INTEGER.' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER.' NOT NULL'
            ]
        );
    }

    public function down()
    {
        $this->dropTable('users');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
