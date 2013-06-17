<?php

class m130328_130604_kit_number extends CDbMigration
{
	public function up()
	{
        $this->createTable("KIT_NUMBER", array(
            "ID"=>"pk",
            "PROPERTY_ID"=>"integer",
            "PROPERTY_VALUE"=>"string",
            "USER_ENTERED"=>"integer",
            "KIT_NUMBER_VALUE"=>"string",
            "CONSTRAINT U_KIT_NUMBER UNIQUE (PROPERTY_ID, PROPERTY_VALUE)"
        ), "");

	}

	public function down()
	{
        $this->dropTable('KIT_NUMBER');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}