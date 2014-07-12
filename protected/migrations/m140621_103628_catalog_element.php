<?php

class m140621_103628_catalog_element extends CDbMigration
{
	public function up()
	{
        $this->execute('
            ALTER TABLE {{catalog_element}}
            ADD COLUMN sort INT NOT NULL DEFAULT 0 AFTER meta_description,
            CHANGE COLUMN published published TINYINT(1) NOT NULL DEFAULT 1 AFTER draft;
        ');
	}

	public function down()
	{
		echo "m140621_103628_catalog_element does not support migration down.\n";
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