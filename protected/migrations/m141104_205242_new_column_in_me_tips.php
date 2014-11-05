<?php

class m141104_205242_new_column_in_me_tips extends CDbMigration
{
	public function up()
	{
		$sql = "ALTER TABLE `{{tips}}` ADD `money_before` DECIMAL(10,0) NOT NULL AFTER `c_profit`, ADD `money_after` DECIMAL(10,0) NOT NULL AFTER `money_before`;";
		return $this->execute($sql);
	}

	public function down()
	{
		$sql = "ALTER TABLE `{{tips}}` DROP `money_before`, DROP `money_after`;";
		return $this->execute($sql);
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