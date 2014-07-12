<?php

class m140604_103427_catalog_element_drop_index extends CDbMigration
{
	public function up()
	{
        $this->execute("
            ALTER TABLE {{catalog_element}}
              DROP INDEX catalog_element_author_id_name,
              CHANGE COLUMN author_id author_id INT(11) NOT NULL DEFAULT 0,
              CHANGE COLUMN name name VARCHAR(100) DEFAULT NULL;
        ");
	}

	public function down()
	{
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