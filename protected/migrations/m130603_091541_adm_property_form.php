<?php

class m130603_091541_adm_property_form extends CDbMigration
{
	public function up()
	{
        $this->createTable('ADM_PROPERTY_FORM', array(
            'ID'=>'pk',
            'PROPERTY_ID'=>'integer',
            'FORM_ID'=>'integer',
            'HTML_ELEMENT_id'=>'integer',
            'POSITION'=>'integer',
            'CREATE_TIME' => 'date',
            'UPDATE_TIME' => 'date',
        ), '');
	}

	public function down()
	{
        $this->dropTable('ADM_PROPERTY_FORM');
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