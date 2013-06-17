<?php

class m130603_091337_adm_visit extends CDbMigration
{
	public function up()
	{
        $this->createTable('ADM_VISIT', array(
            'ID'=>'pk',
            'VISIT_NAME'=>'varchar2(256)',
            'VISIT_INTERVAL'=>'varchar2(5)',
            'CREATE_TIME' => 'date',
            'UPDATE_TIME' => 'date',
        ),'');

        $time = time();
        $this->execute("INSERT INTO ADM_VISIT(VISIT_NAME, VISIT_INTERVAL, CREATE_TIME, UPDATE_TIME)
        VALUES ('SCREENING', '0', '$time', '$time')");
        $this->execute("INSERT INTO ADM_VISIT(VISIT_NAME, VISIT_INTERVAL, CREATE_TIME, UPDATE_TIME)
        VALUES ('BASELINE', '0', '$time', '$time')");
        $this->execute("INSERT INTO ADM_VISIT(VISIT_NAME, VISIT_INTERVAL, CREATE_TIME, UPDATE_TIME)
        VALUES ('PRE-SCREENING', '-1', '$time', '$time')");
        $this->execute("INSERT INTO ADM_VISIT(VISIT_NAME, VISIT_INTERVAL, CREATE_TIME, UPDATE_TIME)
        VALUES ('RECURRENCE', '-1', '$time', '$time')");
        $this->execute("INSERT INTO ADM_VISIT(VISIT_NAME, VISIT_INTERVAL, CREATE_TIME, UPDATE_TIME)
        VALUES ('Anthracyclines Treatment Completion', null, '$time', '$time')");
        $this->execute("INSERT INTO ADM_VISIT(VISIT_NAME, VISIT_INTERVAL, CREATE_TIME, UPDATE_TIME)
        VALUES ('Taxanes Treatment Completion', null, '$time', '$time')");
        $this->execute("INSERT INTO ADM_VISIT(VISIT_NAME, VISIT_INTERVAL, CREATE_TIME, UPDATE_TIME)
        VALUES ('Safety Follow-up', null, '$time', '$time')");
        $this->execute("INSERT INTO ADM_VISIT(VISIT_NAME, VISIT_INTERVAL, CREATE_TIME, UPDATE_TIME)
        VALUES ('Study Treatment Completion', null, '$time', '$time')");
        $this->execute("INSERT INTO ADM_VISIT(VISIT_NAME, VISIT_INTERVAL, CREATE_TIME, UPDATE_TIME)
        VALUES ('Month 36', '1080', '$time', '$time')");
        $this->execute("INSERT INTO ADM_VISIT(VISIT_NAME, VISIT_INTERVAL, CREATE_TIME, UPDATE_TIME)
        VALUES ('Month 60', '1800', '$time', '$time')");
        $this->execute("INSERT INTO ADM_VISIT(VISIT_NAME, VISIT_INTERVAL, CREATE_TIME, UPDATE_TIME)
        VALUES ('RANDOMISATION', '1', '$time', '$time')");
        $this->execute("INSERT INTO ADM_VISIT(VISIT_NAME, VISIT_INTERVAL, CREATE_TIME, UPDATE_TIME)
        VALUES ('YEAR 11', '4015', '$time', '$time')");
        $this->execute("INSERT INTO ADM_VISIT(VISIT_NAME, VISIT_INTERVAL, CREATE_TIME, UPDATE_TIME)
        VALUES ('YEAR 12', '4380', '$time', '$time')");
        $this->execute("INSERT INTO ADM_VISIT(VISIT_NAME, VISIT_INTERVAL, CREATE_TIME, UPDATE_TIME)
        VALUES ('YEAR 13', '4745', '$time', '$time')");
	}

	public function down()
	{
		$this->dropTable('ADM_VISIT');
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