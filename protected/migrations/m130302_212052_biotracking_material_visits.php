<?php

class m130302_212052_biotracking_material_visits extends CDbMigration
{
	public function up()
	{
		$this->createTable("MATERIAL_VISIT", array(
		    "MATERIAL_TYPE"=>"integer",
		    "VISIT_ID"=>"integer",
		    "STUDY_ID"=>"integer",
		    "QUANTITY"=>"NUMBER",
		    "ARM_ID"=>"integer",
		), "");
	}

	public function down()
	{
		echo "m130302_212052_biotracking_material_visits does not support migration down.\n";
		return false;
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