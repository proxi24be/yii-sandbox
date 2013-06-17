<?php

class m130617_121306_adm_generic_value extends CDbMigration
{
    public function up()
    {
        $this->createTable('ADM_GENERIC_VALUE',
            array(
                'ID' => 'pk',
                'DESCRIPTION' => 'varchar2(256)',
                'CREATE_TIME' => 'date',
                'UPDATE_TIME' => 'date',
            ),'');
        $time = time();
        
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (ID, DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES (0, null, $time, $time)");
        
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('LEFT', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('RIGHT', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('FORMALIN', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('UNKNOWN', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('NONE', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('NOT APPLICABLE', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('TISSUE-TEK', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('OTHER', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('FROZEN', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('PARAFFIN EMBEDDED', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('ACCEPTABLE', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('GOOD', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('EXHAUSTED', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('SEVERELY DAMAGED', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('DAMAGED', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('OPTIMUM CUTTING TEMPERATURE (O.C.T.)', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('SNAP FROZEN', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('SAMPLE COLLECTION DELAYED', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('SAMPLE COLLECTION INCOMPLETE', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('SAMPLE HEMOLYZED', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('LOST', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('LIQUID NITROGEN', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('RNA LATER', $time, $time)");
        $this->execute("INSERT INTO ADM_GENERIC_VALUE (DESCRIPTION, CREATE_TIME, UPDATE_TIME)
            VALUES ('DESTROYED', $time, $time)");
    }

    public function down()
	{
		$this->dropTable('ADM_GENERIC_VALUE');
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