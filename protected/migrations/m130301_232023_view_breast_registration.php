<?php

class m130301_232023_view_breast_registration extends CDbMigration
{
	public function up()
	{
		$this->createTable("V_USER_REGISTRATION", array(
		    "USER_ID"=>"integer",
		    "USERNAME"=>"VARCHAR2(50)",
		    "FIRSTNAME"=>"VARCHAR2(100)",
		    "LASTNAME"=>"VARCHAR2(255)",
		    "EMAIL_ADDRESS"=>"VARCHAR2(50)",
		    "ROLE_STUDY_ID"=>"integer",
		    "ROLE_DESCRIPTION"=>"string",
		    "STUDY_ID"=>"integer",
		    "STUDY_DESCRIPTION"=>"string",
		    "PASSWORD"=>"string",
		    "PASSWORD_EXPIRATION"=>"date",
		    "VALIDITY_DATE"=>"date",
		    "COUNTRY"=>"string"
		), "");

		$this->createTable("V_USER_GROUP_PATIENT_SCREEN",array(
		   "STUDY"=>"string",
		   "STUDY_ID"=>"integer",
		   "CLINICAL_STUDY_ID"=>"integer",
		   "USER_ID"=>"integer",
		   "FIRSTNAME"=>"string",
		   "LASTNAME"=>"string",
		   "EMAIL"=>"string",
		   "ROLE_SPONSOR_NAME"=>"string",
		   "NETWORK_ID"=>"integer",
		   "GROUP_ID"=>"integer",
		   "GROUP_NAME"=>"string",
		   "GF_GROUP_ID"=>"integer",
		   "GF_GROUP_NAME"=>"string",
		   "IF_GROUP_ID"=>"integer",
		   "IF_GROUP_NAME"=>"string",
		   "COUNTRY"=>"string",
		   "REGION_ID"=>"innteger",
		   "CENTRE"=>"string",
		   "CURRENT_SITE_ID"=>"integer",
		   "RANDO_CRTN"=>"string",
		   "RANDO_SITE_ID"=>"integer",
		   "PATIENT"=>"string",
		   "PATIENT_POSITION_ID"=>"integer",
		   "SCREENING_PATIENT_ID"=>"integer"
		),"");
	}

	public function down()
	{
		$this->dropTable('V_USER_REGISTRATION');
		$this->dropTable('V_USER_GROUP_PATIENT_SCREEN');
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