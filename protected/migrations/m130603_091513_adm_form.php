<?php

class m130603_091513_adm_form extends CDbMigration
{
	public function up()
	{
        $this->createTable('ADM_FORM', array(
            'ID'=>'pk',
            'SHORT_DESCRIPTION'=>'varchar2(256)',
            'LONG_DESCRIPTION'=>'text',
            'CREATE_TIME' => 'date',
            'UPDATE_TIME' => 'date',
        ), '');
	}

	public function down()
	{
        $this->dropTable('ADM_FORM');
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