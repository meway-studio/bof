<?php

class m140623_103706_add_column_in_running_to_nobettips extends CDbMigration
{
	public function up()
	{
        $this->execute('
            ALTER TABLE {{nobettips}}
            ADD COLUMN in_running TINYINT(1) NOT NULL DEFAULT 0 AFTER meta_d;
        ');
	}

	public function down()
	{
		$this->dropColumn('{{nobettips}}', 'in_running');
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