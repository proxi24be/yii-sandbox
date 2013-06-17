<?php

class m130603_091347_adm_sample extends CDbMigration
{
	public function up()
	{
        $this->createTable('ADM_SAMPLE', array(
            'ID'=>'pk',
            'DESCRIPTION'=>'varchar2(256)',
            'CREATE_TIME' => 'date',
            'UPDATE_TIME' => 'date',
        ),'');

        $time = time();
        $this->execute("INSERT INTO ADM_SAMPLE(DESCRIPTION, CREATE_TIME, UPDATE_TIME) VALUES
        ('TISSUE', '$time', '$time')");
        $this->execute("INSERT INTO ADM_SAMPLE(DESCRIPTION, CREATE_TIME, UPDATE_TIME) VALUES
        ('SERUM', '$time', '$time')");
        $this->execute("INSERT INTO ADM_SAMPLE(DESCRIPTION, CREATE_TIME, UPDATE_TIME) VALUES
        ('BLOOD', '$time', '$time')");
        $this->execute("INSERT INTO ADM_SAMPLE(DESCRIPTION, CREATE_TIME, UPDATE_TIME) VALUES
        ('PLASMA', '$time', '$time')");
	}

	public function down()
	{
        $this->dropTable('ADM_SAMPLE');
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