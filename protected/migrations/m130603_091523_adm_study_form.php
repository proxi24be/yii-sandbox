<?php

class m130603_091523_adm_study_form extends CDbMigration
{
	public function up()
	{
        $this->createTable('ADM_STUDY_FORM', array(
            'ID'=>'pk',
            'STUDY_ID'=>'integer',
            'FORM_ID'=>'integer',
            'CREATE_TIME' => 'date',
            'UPDATE_TIME' => 'date',
        ), '');
	}

	public function down()
	{
        $this->dropTable('ADM_STUDY_FORM');
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