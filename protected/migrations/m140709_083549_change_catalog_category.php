<?php

class m140709_083549_change_catalog_category extends CDbMigration
{
	public function up()
	{
        $this->execute("
            ALTER TABLE {{catalog_category}}
            DROP COLUMN enabled,
            CHANGE COLUMN level level INT(11) NOT NULL DEFAULT 0,
            CHANGE COLUMN image image VARCHAR(255) DEFAULT NULL AFTER full_description,
            ADD COLUMN tpl_inherit TINYINT(1) NOT NULL DEFAULT 1 AFTER image,
            CHANGE COLUMN theme tpl_theme VARCHAR(20) DEFAULT NULL AFTER tpl_inherit,
            ADD COLUMN tpl_path VARCHAR(100) DEFAULT NULL AFTER tpl_theme,
            ADD COLUMN tpl_layout VARCHAR(30) DEFAULT NULL AFTER tpl_path,
            CHANGE COLUMN view tpl_view VARCHAR(30) DEFAULT NULL AFTER tpl_layout,
            CHANGE COLUMN sort sort INT(11) NOT NULL DEFAULT 0 AFTER meta_description,
            CHANGE COLUMN search search TINYINT(1) NOT NULL DEFAULT 1 AFTER sort,
            ADD COLUMN active TINYINT(1) NOT NULL DEFAULT 1 AFTER search;
        ");
	}

	public function down()
	{
		echo "m140709_083549_change_catalog_category does not support migration down.\n";
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