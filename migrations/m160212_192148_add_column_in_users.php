<?php

use yii\db\Schema;
use yii\db\Migration;

class m160212_192148_add_column_in_users extends Migration
{
    public function up()
    {
        $this->addColumn('users', 'image', Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('users', 'image');
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
