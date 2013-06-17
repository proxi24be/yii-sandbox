<?php

class m130302_134202_view_study_breast_tools extends CDbMigration
{
	public function up()
	{
		$this->createTable("V_STUDY_BREAST_TOOLS",array(
			"APP_ID"=>"integer",
			"APP_NAME"=>"string",
			"ROLE_BREAST_ID"=>"integer",
			"ROLE_BREAST"=>"string",
			"ROLE_STUDY_ID"=>"integer",
			"ROLE_STUDY"=>"string",
			"STUDY_ID"=>"integer",
			"STUDY"=>"string"
		),"");
	}

	public function down()
	{
		echo "m130302_134202_view_study_breast_tools does not support migration down.\n";
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