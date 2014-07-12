<?php

class m140622_105431_catalog_element_views extends CDbMigration
{
	public function up()
	{
        $this->execute('
            ALTER TABLE {{catalog_element}}
            ADD COLUMN views INT NOT NULL DEFAULT 0 AFTER meta_description,
            CHANGE COLUMN draft draft TINYINT(1) NOT NULL DEFAULT 0 AFTER views,
            CHANGE COLUMN published published TINYINT(1) NOT NULL DEFAULT 1 AFTER draft;
        ');
	}

	public function down()
	{
		echo "m140622_105431_catalog_element_views does not support migration down.\n";
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