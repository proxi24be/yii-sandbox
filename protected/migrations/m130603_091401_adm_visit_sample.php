<?php

class m130603_091401_adm_visit_sample extends CDbMigration
{
	public function up()
	{
        $this->createTable('ADM_VISIT_SAMPLE', array(
            'ID'=>'pk',
            'STUDY_ID' =>'integer',
            'VISIT_ID'=>'integer',
            'SAMPLE_ID'=>'integer',
            'CREATE_TIME' => 'date',
            'UPDATE_TIME' => 'date',
            'FOREIGN KEY(STUDY_ID) REFERENCES ADM_STUDY(ID)',
            'FOREIGN KEY(VISIT_ID) REFERENCES ADM_VISIT(ID)',
            'FOREIGN KEY(SAMPLE_ID) REFERENCES ADM_SAMPLE(ID)',
            'CONSTRAINT U_STUDY_VISIT_SAMPLE UNIQUE (STUDY_ID, VISIT_ID, SAMPLE_ID)',
        ), '');
	}

	public function down()
	{
		$this->dropTable('ADM_VISIT_SAMPLE');
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