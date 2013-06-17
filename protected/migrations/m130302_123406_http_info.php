<?php

class m130302_123406_http_info extends CDbMigration
{
	public function up()
	{
		$this->createTable("USER_HTTP_INFO", array(
		    "ID"=>"pk",
		    "DATE_CONNECTION"=>"DATE",
		    "USER_AGENT"=>"VARCHAR2(512)",
		    "IP"=>"VARCHAR2(100)",
		    "USER_ID"=>"NUMBER",
		), "");
	}

	public function down()
	{
		echo "m130302_123406_http_info does not support migration down.\n";
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