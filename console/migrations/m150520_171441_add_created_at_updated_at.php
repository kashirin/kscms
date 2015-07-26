<?php

use yii\db\Schema;
use yii\db\Migration;

class m150520_171441_add_created_at_updated_at extends Migration
{
    public function up()
    {
        $this->addColumn('structure', 'created_at', Schema::TYPE_INTEGER . ' NOT NULL');
        $this->addColumn('structure', 'updated_at', Schema::TYPE_INTEGER . ' NOT NULL');
    }

    public function down()
    {
        echo "m150520_171441_add_created_at_updated_at cannot be reverted.\n";

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
