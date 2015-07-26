<?php

use yii\db\Schema;
use yii\db\Migration;

class m150615_192938_add_seourl extends Migration
{
    public function up()
    {
		$this->addColumn('structure', 'seourl', Schema::TYPE_STRING);
    }

    public function down()
    {
        echo "m150615_192938_add_seourl cannot be reverted.\n";

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
