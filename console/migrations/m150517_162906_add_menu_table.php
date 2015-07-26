<?php

use yii\db\Schema;
use yii\db\Migration;

class m150517_162906_add_menu_table extends Migration
{
    public function up()
    {
        $this->createTable('structure', [
            'id' => Schema::TYPE_PK,
            'label' => Schema::TYPE_STRING . ' NOT NULL',
            'url' => Schema::TYPE_STRING . ' NOT NULL', // Yii2 controller/action bases url
            'params' => Schema::TYPE_STRING, // get params if needed a=8&r=8...
            'info' => Schema::TYPE_TEXT, // title, keywords etc
            'sort' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0', //  sort
            'level' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1', // depth level for item
            'collapsed' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0', // 1 - is collapses
        ]);
    }

    public function down()
    {
        $this->dropTable('structure');
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
