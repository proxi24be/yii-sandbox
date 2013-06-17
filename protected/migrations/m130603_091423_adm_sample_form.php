<?php

class m130603_091423_adm_sample_form extends CDbMigration
{
	public function up()
	{
        $this->createTable('ADM_SAMPLE_FORM', array(
            'ID'=>'pk',
            'SAMPLE_ID'=>'integer',
            'FORM_ID'=>'integer',
            'POSITION'=>'integer',
            'CREATE_TIME' => 'date',
            'UPDATE_TIME' => 'date',
        ), '');
	}

	public function down()
	{
        $this->dropTable('ADM_SAMPLE_FORM');
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