<?php

class m140623_122003_table_banner extends CDbMigration
{
	public function up()
	{
        $this->execute("
            CREATE TABLE {{banner}} (
                id int(11) NOT NULL AUTO_INCREMENT,
                create_date timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                update_date timestamp NULL DEFAULT '0000-00-00 00:00:00',
                title varchar(255) DEFAULT NULL,
                image varchar(255) DEFAULT NULL,
                `show` enum ('ALL', 'GUEST', 'AUTHORIZED') DEFAULT 'ALL',
                url varchar(255) DEFAULT NULL,
                sort int(11) NOT NULL DEFAULT 0,
                active tinyint(1) NOT NULL DEFAULT 1,
                lang varchar(4) DEFAULT NULL,
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
		$this->dropTable('{{banner}}');
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