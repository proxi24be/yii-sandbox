<?php

class m130301_220118_breast_registration extends CDbMigration
{
	public function up()
	{
		$this->createTable("USER_REGISTRATION", array(
		    "USER_ID"=>"pk",
		    "FIRSTNAME"=>"string",
		    "LASTNAME"=>"string",
		    "EMAIL_ADDRESS"=>"string",
		    "USERNAME"=>"string",
		    "PASSWORD"=>"string",
		    "REGISTRATION_IS_COMPLETED"=>"string",
		    "LAST_CONNECTION"=>"DATE",
		    "IS_ENABLE"=>"string",
		    "ROLE_STUDY_ID"=>"integer",
		    "STUDY_ID"=>"NUMBER",
		    "CREATION_DATE"=>"DATE",
		    "PASSWORD_EXPIRATION"=>"DATE",
		    "PASSWORD_START"=>"DATE",
		    "VALIDITY_DATE"=>"DATE",
		), "");
	}

	public function down()
	{
		$this->dropTable('USER_REGISTRATION');
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