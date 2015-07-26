<?php

use yii\db\Schema;
use yii\db\Migration;

class m150609_191922_add_file_and_image extends Migration
{
    public function up()
    {
		$this->addColumn('structure', 'file', Schema::TYPE_STRING);
		$this->addColumn('structure', 'image', Schema::TYPE_STRING);
    }

    public function down()
    {
        echo "m150609_191922_add_file_and_image cannot be reverted.\n";

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
