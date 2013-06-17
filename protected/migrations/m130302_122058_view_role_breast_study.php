<?php

class m130302_122058_view_role_breast_study extends CDbMigration
{
	public function up()
	{
		$this->createTable("V_ROLE_BREAST_STUDY",array(
		   "ROLE_BREAST_ID"=>"integer",
		   "ROLE_BREAST"=>"string",
		   "BREAST_PROFILE_ID"=>"integer",
		   "BREAST_PROFILE"=>"string",
		   "ROLE_STUDY_ID"=>"integer",
		   "ROLE_STUDY"=>"string",
		   "STUDY_ID"=>"integer",
		   "STUDY"=>"string"
		),"");
	}

	public function down()
	{
		echo "m130302_122058_view_role_breast_study does not support migration down.\n";
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