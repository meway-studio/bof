<?php

class m140619_114359_table_catalog_order_element extends CDbMigration
{
	public function up()
	{
        $this->execute('
            CREATE TABLE {{catalog_order_element}} (
                id int(11) NOT NULL AUTO_INCREMENT,
                order_id int(11) NOT NULL,
                element_id int(11) NOT NULL,
                create_date timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                update_date timestamp NULL DEFAULT NULL,
                quantity int(11) DEFAULT 1,
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
		$this->dropTable('{{catalog_order_element}}');
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