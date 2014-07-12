<?php

class m140506_114003_change_catalog_element_public_date extends CDbMigration
{
	public function up()
	{
        try {
            $this->execute("
                ALTER TABLE me_catalog_element
                CHANGE COLUMN public_date publish_date TIMESTAMP NULL DEFAULT NULL;
            ");
        } catch (Exception $e) {}

	}

	public function down()
	{
        try {
            $this->execute("
                ALTER TABLE me_catalog_element
                CHANGE COLUMN publish_date public_date TIMESTAMP NULL DEFAULT NULL;
            ");
        } catch (Exception $e) {}
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