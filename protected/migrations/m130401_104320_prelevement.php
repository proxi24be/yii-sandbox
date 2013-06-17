<?php

class m130401_104320_prelevement extends MyCDbMigration
{
	public function up()
	{
        $this->createTable("PRELEVEMENT", array(
            "ID" => "pk",
            "VISIT_ID" => "integer",
            "PATIENT_ID" => "integer",
            "COLLECTION_DATE" => "date",
            "DATE_CREATED" => "timestamp DEFAULT $this->CURRENT_TIMESTAMP_YYYYMMDD",
            "STUDY_ID" => "integer",
            "USER_ENTERED" => "integer",
        ), "");
	}

	public function down()
	{
		$this->dropTable('PRELEVEMENT');
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