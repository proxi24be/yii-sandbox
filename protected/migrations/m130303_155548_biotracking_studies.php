<?php

class m130303_155548_biotracking_studies extends CDbMigration
{
	public function up()
	{
		$this->createTable("STUDIES", array(
		    "STUDY_ID"=>"integer",
		    "SHORT_DESCRIPTION"=>"string",
		    "LONG_DESCRIPTION"=>"string",
		), "");

	}

	public function down()
	{
		echo "m130303_155548_biotracking_studies does not support migration down.\n";
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