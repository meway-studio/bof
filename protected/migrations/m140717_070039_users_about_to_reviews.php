<?php

class m140717_070039_users_about_to_reviews extends CDbMigration
{
	public function up()
	{
        $this->execute("
            INSERT INTO {{reviews}} (user_id, content)
            SELECT mu.id, mu.about
            FROM {{users}} mu LEFT JOIN {{reviews}} mr ON mu.id = mr.user_id
            WHERE mr.user_id IS NULL AND TRIM(BOTH FROM mu.about) != ''
        ");
	}

	public function down()
	{
		echo "m140717_070039_users_about_to_reviews does not support migration down.\n";
		return false;
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