<?php

class m140428_142253_alter_catalog_category_index extends CDbMigration
{
	public function up()
	{
        try {
            $this->execute("
                ALTER TABLE {{catalog_category}}
                CHANGE COLUMN parent_id parent_id INT(11) DEFAULT NULL;

                ALTER TABLE {{catalog_category}}
                DROP INDEX catalog_category_name,
                ADD UNIQUE INDEX catalog_category_name (name, parent_id);
            ");
        } catch (Exception $e) {}
	}

	public function down()
	{
        echo "Migration does not support migration down.\n";
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