<?php

class m140901_082558_tipsters_sort extends CDbMigration
{
	public function up()
	{
        $this->execute("
            ALTER TABLE {{tipsters}}
            ADD COLUMN sort INT NOT NULL DEFAULT 0 AFTER meta_d;
        ");
	}

	public function down()
	{
		$this->dropColumn('{{tipsters}}', 'sort');
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