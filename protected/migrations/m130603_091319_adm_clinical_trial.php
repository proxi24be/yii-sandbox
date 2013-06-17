<?php

class m130603_091319_adm_clinical_trial extends CDbMigration
{
	public function up()
	{
        $this->createTable('ADM_CLINICAL_TRIAL',
        array(
            'ID'=>'pk',
            'STUDY_ID'=>'integer',
            'VERSION_NAME'=>'varchar(256)',
            'PRODUCTION'=>'boolean',
            'COMMENT'=>'text',
            'CREATE_TIME' => 'date',
            'UPDATE_TIME' => 'date',
            ),'');
	}

	public function down()
	{
        $this->dropTable('ADM_CLINICAL_TRIAL');
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