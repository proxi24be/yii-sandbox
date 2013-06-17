<?php

class m130302_000120_view_biotracking extends CDbMigration
{
	public function up()
	{
		$this->createTable("V_MATERIAL_TYPE_PROPERTIES", array(
		   "MATERIAL_TYPE_ID"=>"integer",
		   "MATERIAL_TYPE"=>"string",
		   "CODE"=>"string",
		   "PROPERTY_ID"=>"integer",
		   "PROPERTY"=>"string",
		   "GENERIC_VALUE_ID"=>"integer",
		   "GENERIC_VALUE"=>"string",
		   "STUDY_ID"=>"integer"
		), "");


		$this->createTable("V_MATERIAL_PROPERTY_VALUE", array(
		   "PROPERTY_ID"=>"integer",
		   "PROPERTY"=>"string",
		   "GENERIC_VALUE_ID"=>"integer",
		   "GENERIC_VALUE"=>"string",
		   "STUDY_ID"=>"integer",
		   "STUDY"=>"string"
		), "");
	}

	public function down()
	{
		$this->dropTable("V_MATERIAL_TYPE_PROPERTIES");
		$this->dropTable("V_MATERIAL_PROPERTY_VALUE");
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