<?php

class m140709_083600_change_catalog_element extends CDbMigration
{
	public function up()
	{
        $this->execute("
            ALTER TABLE {{catalog_element}}
            ADD COLUMN tpl_inherit TINYINT(1) NOT NULL DEFAULT 0 AFTER image,
            ADD COLUMN tpl_theme VARCHAR(20) DEFAULT NULL AFTER tpl_inherit,
            ADD COLUMN tpl_path VARCHAR(100) DEFAULT NULL AFTER tpl_theme,
            ADD COLUMN tpl_layout VARCHAR(30) DEFAULT NULL AFTER tpl_path,
            ADD COLUMN tpl_view VARCHAR(30) DEFAULT NULL AFTER tpl_layout;

            ALTER TABLE {{catalog_element}}
            ADD CONSTRAINT FK_catalog_element_catalog_category_id FOREIGN KEY (category_id)
            REFERENCES {{catalog_category}}(id) ON DELETE CASCADE ON UPDATE NO ACTION;
        ");
	}

	public function down()
	{
		echo "m140709_083600_change_catalog_element does not support migration down.\n";
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