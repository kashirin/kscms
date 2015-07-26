<?php

use yii\db\Schema;
use yii\db\Migration;

class m150518_183602_add_parent_column extends Migration
{
    public function up()
    {
		$this->addColumn('structure', 'parent_id', Schema::TYPE_INTEGER . ' DEFAULT NULL');
    }

    public function down()
    {
        echo "m150518_183602_add_parent_column cannot be reverted.\n";

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
