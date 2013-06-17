<?php

class m130617_121256_adm_property extends CDbMigration
{
	public function up()
	{
        $this->createTable('ADM_PROPERTY',
        array(
           'ID' => 'pk',
            'DESCRIPTION' => 'varchar2(256)',
            'CREATE_TIME' => 'date',
            'UPDATE_TIME' => 'date',
        ),'');
        $time = time();
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('FIXATIVE', $time, $time)");
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('LATERALITY', $time, $time)");
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('CONDITIONING', $time, $time)");
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('COLLECTION_TIME', $time, $time)");
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('LOCAL_ID', $time, $time)");
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('SAMPLE_STATE', $time, $time)");
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('CRYOVIALS_NUMBER', $time, $time)");
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('SAMPLE_NUMBER', $time, $time)");
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('TEMPERATURE', $time, $time)");
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('CYCLE_TIMEPOINT', $time, $time)");
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('TREATMENT_NAME', $time, $time)");
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('COLLECTION_ISSUE', $time, $time)");
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('DNA_ID', $time, $time)");
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('TMA_ID', $time, $time)");
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('DNA_CORE', $time, $time)");
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('RNA_CORE', $time, $time)");
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('TMA_CORE', $time, $time)");
        $this->execute("INSERT INTO ADM_PROPERTY (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('PREPARATION_DATE', $time, $time)");
	}

	public function down()
	{

        $this->dropTable('ADM_PROPERTY');
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