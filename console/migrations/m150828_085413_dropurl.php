<?php

use yii\db\Schema;
use yii\db\Migration;

class m150828_085413_dropurl extends Migration
{
    public function up()
    {
	$this->dropColumn('event', 'url');
    }

    public function down()
    {
        echo "m150828_085413_dropurl cannot be reverted.\n";

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
