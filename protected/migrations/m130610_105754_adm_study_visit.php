<?php

class m130610_105754_adm_study_visit extends CDbMigration
{
	public function up()
	{
        $this->createTable('ADM_STUDY_VISIT', array(
            'ID'=>'pk',
            'STUDY_ID'=>'integer',
            'VISIT_ID'=>'integer',
            'CREATE_TIME' => 'date',
            'UPDATE_TIME' => 'date',
            'FOREIGN KEY(STUDY_ID) REFERENCES ADM_STUDY(ID)',
            'FOREIGN KEY(VISIT_ID) REFERENCES ADM_VISIT(ID)',
            'CONSTRAINT U_STUDY_VISIT UNIQUE (STUDY_ID, VISIT_ID)',
        ), '');
	}

	public function down()
	{
		$this->dropTable('ADM_STUDY_VISIT');
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