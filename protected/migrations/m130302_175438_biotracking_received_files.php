<?php

class m130302_175438_biotracking_received_files extends CDbMigration
{
	public function up()
	{
		$this->createTable("RECEIVED_FILES", array(
		    "ID"=>"pk",
		    "RESULTS_SENT"=>"NUMBER DEFAULT '0'",
		    "STUDY_ID"=>"NUMBER",
		    "PATIENT_NUMBER"=>"VARCHAR2(20)",
		    "DOB"=>"VARCHAR2(20)",
		    "SCREENING_DATE"=>"VARCHAR2(20)",
		    "RANDOMISATION_DATE"=>"VARCHAR2(20)",
		    "NODAL_STATUS"=>"VARCHAR2(20)",
		    "ADJUVANT_CHEMO_REGIMEN"=>"VARCHAR2(20)",
		    "SAMPLE_KIT_ID"=>"VARCHAR2(20)",
		    "CODEBREAK_STATUS"=>"VARCHAR2(20)",
		    "DATE_RECEIVED"=>"DATE",
		    "FILENAME"=>"VARCHAR2(200)",
		    "SCREENING_FAILURE"=>"VARCHAR2(50)",
		    "PK_STUDY"=>"VARCHAR2(50)",
		), "");
	}

	public function down()
	{
		echo "m130302_175438_biotracking_received_files does not support migration down.\n";
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