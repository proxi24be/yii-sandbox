<?php

class m130515_092631_benchmark extends CDbMigration
{
	public function up()
	{
        $this->createTable('BENCHMARK', array(
            'ID' => 'pk',
            'DATA' => 'text',
            'FRAMEWORK' =>'varchar(512)',
            'TIMESTAMP' =>'date'
        ));
	}

	public function down()
	{
        $this->dropTable('BENCHMARK');
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