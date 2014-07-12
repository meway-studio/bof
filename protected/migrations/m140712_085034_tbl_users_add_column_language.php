<?php

class m140712_085034_tbl_users_add_column_language extends CDbMigration
{
	public function up()
	{
        $this->execute("
            ALTER TABLE {{users}}
            ADD COLUMN language ENUM('en','ru') DEFAULT 'en' AFTER country_id;
        ");
	}

	public function down()
	{
		$this->dropColumn("{{users}}", "language");
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