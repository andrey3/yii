<?php

use yii\db\Schema;
use yii\db\Migration;

class m160211_152429_add_column_in_links extends Migration
{
    public function up()
    {
        $this->addColumn('links', 'used', 'int(5) not null');
    }

    public function down()
    {
        $this->dropColumn('links', 'used');
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
