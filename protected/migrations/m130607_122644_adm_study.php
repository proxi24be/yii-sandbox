<?php

class m130607_122644_adm_study extends CDbMigration
{
    public function up()
    {
        $this->createTable('ADM_STUDY', array(
            'ID'=>'pk',
            'DESCRIPTION'=>'varchar2(256)',
            'ORACLE_CLINICAL_ID'=>'integer',
            'CREATE_TIME' => 'date',
            'UPDATE_TIME' => 'date',
        ), '');

        $time = time();
        $this->execute("INSERT INTO ADM_STUDY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('ZEUS', '$time', '$time')");
        $this->execute("INSERT INTO ADM_STUDY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('VIVENDI', '$time', '$time')");
        $this->execute("INSERT INTO ADM_STUDY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('NEO-VIVENDI', '$time', '$time')");
    }

    public function down()
    {
        $this->dropTable('ADM_STUDY');
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