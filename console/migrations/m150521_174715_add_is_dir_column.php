<?php

use yii\db\Schema;
use yii\db\Migration;

class m150521_174715_add_is_dir_column extends Migration
{
    public function up()
    {
        $this->addColumn('structure', 'is_dir', Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0');
    }

    public function down()
    {
        echo "m150521_174715_add_is_dir_column cannot be reverted.\n";

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
