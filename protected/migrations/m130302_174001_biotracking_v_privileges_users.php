<?php

class m130302_174001_biotracking_v_privileges_users extends CDbMigration
{
	public function up()
	{
		$this->createTable("V_PRIVILEGES_USERS",array(
			"USER_ID"=>"integer",
			"LASTNAME"=>"string",
			"FIRSTNAME"=>"string",
			"LOG_USERNAME"=>"string",
			"EMAILADDRESS"=>"string",
			"EFFECTIVE_START_DATE"=>"date",
			"EFFECTIVE_END_DATE"=>"date",
			"STUDY_ID"=>"integer",
			"CENTRE_ID"=>"integer",
			"COUNTRY_ID"=>"integer",
			"STUDY_SHORT_DESCRIPTION"=>"string",
			"CENTRE"=>"string"
		),"");
	}

	public function down()
	{
		echo "m130302_174001_biotracking_v_privileges_users does not support migration down.\n";
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