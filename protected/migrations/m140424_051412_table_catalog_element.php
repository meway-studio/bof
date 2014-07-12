<?php

class m140424_051412_table_catalog_element extends CDbMigration
{
	public function up()
	{
        $this->execute("
            CREATE TABLE {{catalog_element}} (
                id int(11) NOT NULL AUTO_INCREMENT,
                category_id int(11) DEFAULT NULL,
                create_date timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                update_date timestamp NULL DEFAULT NULL,
                public_date timestamp NULL DEFAULT NULL,
                author_id int(11) NOT NULL DEFAULT 0,
                name varchar(100) DEFAULT NULL,
                title varchar(255) DEFAULT NULL,
                short_description tinytext DEFAULT NULL,
                full_description longtext DEFAULT NULL,
                image varchar(255) DEFAULT NULL,
                source longtext DEFAULT NULL,
                meta_title varchar(255) DEFAULT NULL,
                meta_keywords varchar(255) DEFAULT NULL,
                meta_description varchar(255) DEFAULT NULL,
                PRIMARY KEY (id),
                UNIQUE INDEX catalog_element_author_id_name (author_id, name)
            )
            ENGINE = INNODB
            AUTO_INCREMENT = 1
            CHARACTER SET utf8
            COLLATE utf8_general_ci;
        ");
	}

	public function down()
	{
		$this->dropTable("{{catalog_element}}");
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