<?php

use yii\db\Schema;
use yii\db\Migration;

class m160211_151959_create_links_table extends Migration
{
    public function up()
    {
        $this->createTable('links',
            [
                'id'=>Schema::TYPE_PK,
                'email' => Schema::TYPE_STRING.' NOT NULL',
                'token' => Schema::TYPE_STRING.'(32) NOT NULL',
                'created_at' => Schema::TYPE_INTEGER.' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER.' NOT NULL'
            ]
        );
    }

    public function down()
    {
        $this->dropTable('links');
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
