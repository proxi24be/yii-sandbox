<?php

class m130301_221213_biotracking extends CDbMigration
{
	public function up()
	{
		$this->createTable("VISITS", array(
		    "VISIT_ID"=>"pk",
		    "VISIT_NAME"=>"VARCHAR2(50)",
		    "VISIT_DESCRIPTION"=>"VARCHAR2(512)",
		    "TIME_UNIT_ID"=>"integer",
		    "VISIT_UNITS_integer"=>"integer",
		    "VISIT_INTERVAL"=>"integer",
		), "");

		$this->createTable("CONTACT_PERSONS", array(
		    "CONTACT_ID"=>"pk",
		    "CONTACT_LASTNAME"=>"VARCHAR2(100)",
		    "CONTACT_EMAIL"=>"VARCHAR2(100)",
		    "CONTACT_FAX"=>"VARCHAR2(50)",
		    "CONTACT_PHONE"=>"VARCHAR2(50)",
		    "CONTACT_MOBILE"=>"VARCHAR2(50)",
		    "CONTACT_NOTE"=>"VARCHAR2(255)",
		    "FUNCTION_ID"=>"integer",
		    "CONTACT_FORENAME"=>"VARCHAR2(100)",
		), "");

		$this->createTable("LABORATORIES", array(
		    "LAB_ID"=>"pk",
		    "COUNTRY_ID"=>"integer(3)",
		    "date_OPENED"=>"date",
		    "date_CLOSED"=>"date",
		    "SHORT_DESCRIPTION"=>"VARCHAR2(10)",
		    "LONG_DESCRIPTION"=>"VARCHAR2(100)",
		    "PHONE_integer"=>"VARCHAR2(50)",
		    "FAX_integer"=>"VARCHAR2(50)",
		    "EMAIL"=>"VARCHAR2(100)",
		    "CONTACT_PERSON"=>"VARCHAR2(100)",
		    "ADDRESS_ID"=>"integer",
		), "");


		$this->createTable("MATERIALS", array(
		    "MATERIAL_ID"=>"pk",
		    "PARENT_ID"=>"integer(10)",
		    "MATERIAL_TYPE"=>"integer(2)",
		    "PRELEVEMENT_ID"=>"integer",
		), "");

		$this->createTable("PATIENTS", array(
		    "PATIENT_ID"=>"pk",
		    "STUDY_ID"=>"integer",
		    "CENTRE_ID"=>"integer",
		    "DESCRIPTION"=>"VARCHAR2(10)",
		    "BIRTHdate"=>"date",
		    "date_CREATED"=>"date DEFAULT 'SYSdate'",
		    "IS_RANDOMIZED"=>"integer DEFAULT '0'",
		    "SCREENING_integer"=>"VARCHAR2(100)",
		    "SCREENING_APPROVED"=>"integer DEFAULT '0'",
		    "ARM_ID"=>"integer",
		    ), "");

		$this->createTable("AIRWAY_NUMBERS", array(
		    "MATERIAL_ID"=>"integer",
		    "AIRWAY_integer"=>"VARCHAR2(255)",
		    "AIRWAY_TIMESTAMP"=>"date DEFAULT 'SYSdate'",
		    "date_PICKUP"=>"date",
		    "USER_ID"=>"integer",
		), "");

		$this->createTable("SAMPLE_NUMBERS", array(
		    "SAMPLE_integer"=>"integer",
		    "VISIT_ID"=>"integer",
		    "MATERIAL_TYPE"=>"integer",
		), "");

		$this->createTable("MATERIAL_CL_RECEPTION", array(
		    "MATERIAL_ID"=>"integer",
		    "CL_RECEPTION_date"=>"date",
		    "TIMESTAMP"=>"date",
		    "USER_ID"=>"integer",
		), "");

		$this->createTable("CL_IMPORT_RETURN_BLOCK", array(
		    "PATIENT_integer"=>"VARCHAR2(20)",
		    "N_HISTO"=>"VARCHAR2(50)",
		    "RETURN_date"=>"VARCHAR2(15)",
		    "AWB"=>"VARCHAR2(50)",
		    "ID"=>"integer",
		), "");

		$this->createTable("LABORATORIES_CENTRES", array(
		    "LAB_ID"=>"pk",
		    "CENTRE_ID"=>"integer",
		    "STUDY_ID"=>"integer",
		), "");

		$this->createTable("RESPONSES", array(
		    "RESPONSE_ID"=>"pk",
		    "MATERIAL_ID"=>"integer(10)",
		    "FORM_ID"=>"integer(5)",
		    "QUESTION_ID"=>"integer(5)",
		    "SEQ_NUM"=>"integer(6)",
		    "ENTERED_date"=>"date",
		    "USER_ENTERED"=>"integer(6)",
		    "MODIFICATION_date"=>"date",
		    "MODIFICATION_USER"=>"integer(6)",
		    "VALUE"=>"VARCHAR2(200)",
		    "EXCP_VALUE"=>"VARCHAR2(200)",
		    "TOP_PARENT"=>"integer(10)",
		    "QUESTION_REPEAT"=>"integer(6)",
		), "");

		$this->createTable("LABS_CONTACTS", array(
		    "LAB_ID"=>"pk",
		    "CONTACT_ID"=>"integer",
		), "");

		$this->createTable("ADDRESSES", array(
		    "ADDRESS_ID"=>"pk",
		    "ADDRESS_STREET"=>"VARCHAR2(255)",
		    "ADDRESS_POSTCODE"=>"VARCHAR2(30)",
		    "ADDRESS_STATE"=>"VARCHAR2(255)",
		    "COUNTRY_ID"=>"integer(3)",
		    "ADDRESS_CITY"=>"VARCHAR2(255)",
		), "");

		$this->createTable("MATERIAL_DETAILS", array(
		    "MATERIAL_ID"=>"integer",
		    "PROPERTY_ID"=>"integer",
		    "VALUE"=>"VARCHAR2(50)",
		), "");

		$this->createTable("RETURN_ADDRESSES", array(
		    "MATERIAL_ID"=>"integer",
		    "ADDRESS_ID"=>"integer",
		), "");

	}

	public function down()
	{
		echo "m130301_221213_biotracking does not support migration down.\n";
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