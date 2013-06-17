<?php

class m130302_175940_biotracking_material_types extends CDbMigration
{
	public function up()
	{
		$this->createTable("MATERIAL_TYPES", array(
		    "MATERIAL_TYPE"=>"integer",
		    "DESCRIPTION"=>"VARCHAR2(100)",
		    "CODE"=>"VARCHAR2(6)",
		), "");
	}

	public function down()
	{
		echo "m130302_175940_biotracking_material_types does not support migration down.\n";
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