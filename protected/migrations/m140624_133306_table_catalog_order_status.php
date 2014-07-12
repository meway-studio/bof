<?php

class m140624_133306_table_catalog_order_status extends CDbMigration
{
	public function up()
	{
        $this->execute("
            CREATE TABLE {{catalog_order_status}} (
                id int(11) NOT NULL AUTO_INCREMENT,
                create_date timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                update_date timestamp NULL DEFAULT NULL,
                category_id int(11) DEFAULT NULL,
                title varchar(255) NOT NULL,
                code varchar(50) NOT NULL,
                description text DEFAULT NULL,
                sort int(11) NOT NULL DEFAULT 0,
                active tinyint(11) NOT NULL DEFAULT 1,
                PRIMARY KEY (id)
            )
            ENGINE = INNODB
            AUTO_INCREMENT = 1
            CHARACTER SET utf8
            COLLATE utf8_general_ci;
        ");
	}

	public function down()
	{
        $this->dropTable('{{catalog_order_status}}');
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