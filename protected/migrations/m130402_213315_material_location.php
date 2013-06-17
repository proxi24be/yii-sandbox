<?php

class m130402_213315_material_location extends MyCDbMigration
{
	public function up()
	{
        $this->createTable("MATERIAL_LOCATION", array(
            "ID"=>"pk",
            "MATERIAL_ID"=>"integer",
            "LOCATION_ID"=>"integer",
            "TIMESTAMP"=>"timestamp DEFAULT $this->CURRENT_TIMESTAMP_YYYYMMDD",
            "LOC_TYPE_ID"=>"integer",
        ), "");
	}

	public function down()
	{
        $this->dropTable('MATERIAL_LOCATION');
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