<?php

class m130603_091553_adm_html_element extends CDbMigration
{
	public function up()
	{
        $this->createTable('ADM_HTML_ELEMENT', array(
            'ID'=>'pk',
            'DESCRIPTION'=>'varchar2(256)',
            'CREATE_TIME' => 'date',
            'UPDATE_TIME' => 'date',
        ), '');

        $time = time();
        $this->execute ("INSERT INTO ADM_HTML_ELEMENT (DESCRIPTION, CREATE_TIME, UPDATE_TIME) VALUES
            ('select', $time, $time)");
        $this->execute ("INSERT INTO ADM_HTML_ELEMENT (DESCRIPTION, CREATE_TIME, UPDATE_TIME) VALUES
            ('radio', $time, $time)");
        $this->execute ("INSERT INTO ADM_HTML_ELEMENT (DESCRIPTION, CREATE_TIME, UPDATE_TIME) VALUES
            ('input_text', $time, $time)");
        $this->execute ("INSERT INTO ADM_HTML_ELEMENT (DESCRIPTION, CREATE_TIME, UPDATE_TIME) VALUES
            ('textarea', $time, $time)");
    }

	public function down()
	{
        $this->dropTable('ADM_HTML_ELEMENT');
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