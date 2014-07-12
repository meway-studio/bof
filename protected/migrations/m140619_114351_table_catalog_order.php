<?php

class m140619_114351_table_catalog_order extends CDbMigration
{
	public function up()
	{
        $this->execute('
            CREATE TABLE {{catalog_order}} (
                id int(11) NOT NULL AUTO_INCREMENT,
                user_id int(11) DEFAULT NULL,
                create_date timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                update_date timestamp NULL DEFAULT NULL,
                user_name varchar(100) DEFAULT NULL,
                user_email varchar(50) DEFAULT NULL,
                user_address varchar(255) DEFAULT NULL,
                user_phone varchar(255) DEFAULT NULL,
                comment text DEFAULT NULL,
                delivery int(4) DEFAULT 0,
                status int(10) DEFAULT 0,
                PRIMARY KEY (id)
            )
            ENGINE = INNODB
            AUTO_INCREMENT = 1
            CHARACTER SET utf8
            COLLATE utf8_general_ci;
        ');
	}

	public function down()
	{
        $this->dropTable('{{catalog_order}}');
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