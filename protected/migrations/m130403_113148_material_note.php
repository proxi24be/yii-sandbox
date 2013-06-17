<?php

class m130403_113148_material_note extends MyCDbMigration
{
	public function up()
	{
        $this->createTable("MATERIAL_NOTES", array(
            "ID"=>"pk",
            "MATERIAL_ID"=>"integer",
            "MATERIAL_NOTE"=>"string",
            "DATE_CREATED"=>"timestamp DEFAULT $this->CURRENT_TIMESTAMP_YYYYMMDD",
            "USER_ID"=>"integer",
            "DATE_CLOSED"=>"timestamp",
        ), "");
	}

	public function down()
	{
		$this->dropTable('MATERIAL_NOTES');
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