<?php

use yii\db\Schema;
use yii\db\Migration;

class m160213_110550_drop_column_in_links extends Migration
{
    public function up()
    {
        $this->dropColumn('links', 'used');
    }

    public function down()
    {
        echo "m160213_110550_drop_column_in_links cannot be reverted.\n";

        return false;
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
