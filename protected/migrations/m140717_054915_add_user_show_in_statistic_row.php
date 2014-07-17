<?php

class m140717_054915_add_user_show_in_statistic_row extends CDbMigration
{
	public function up()
	{
        $this->execute("
            ALTER TABLE {{users}}
            ADD COLUMN show_in_statistic TINYINT(1) NOT NULL DEFAULT 1 AFTER last_mail;
        ");
	}

	public function down()
	{
		$this->dropColumn("{{users}}", "show_in_statistic");
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