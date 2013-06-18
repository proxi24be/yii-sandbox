<?php

class m130618_081310_adm_news extends CDbMigration
{
	public function up()
	{
        $this->createTable('ADM_NEWS', array(
           'ID' => 'pk',
            'TITLE' => 'varchar2(256)',
            'CONTENT' => 'varchar2(8192)',
            'CREATE_TIME' => 'date',
            'UPDATE_TIME' => 'date',
        ), '');
	}

	public function down()
	{
		$this->dropTable('ADM_NEWS');
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