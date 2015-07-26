<?php

use yii\db\Schema;
use yii\db\Migration;

class m150609_181325_add_keywords extends Migration
{
    public function up()
    {
		$this->addColumn('structure', 'keywords', Schema::TYPE_TEXT);
		$this->addColumn('structure', 'description', Schema::TYPE_TEXT);
		$this->addColumn('structure', 'title', Schema::TYPE_STRING);
		$this->addColumn('structure', 'content', Schema::TYPE_TEXT);
    }

    public function down()
    {
        echo "m150609_181325_add_keywords cannot be reverted.\n";

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
