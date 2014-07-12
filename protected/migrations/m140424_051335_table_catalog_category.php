<?php

class m140424_051335_table_catalog_category extends CDbMigration
{
	public function up()
	{
        $this->execute("
            CREATE TABLE {{catalog_category}} (
                id int(11) NOT NULL AUTO_INCREMENT,
                create_date timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                update_date timestamp NULL DEFAULT NULL,
                root_id int(11) DEFAULT NULL,
                left_id int(11) DEFAULT NULL,
                right_id int(11) DEFAULT NULL,
                parent_id int(11) DEFAULT NULL,
                author_id int(11) DEFAULT NULL,
                level int(11) DEFAULT 0,
                name varchar(100) DEFAULT NULL,
                title varchar(255) DEFAULT NULL,
                short_description tinytext DEFAULT NULL,
                full_description longtext DEFAULT NULL,
                source longtext DEFAULT NULL,
                theme varchar(20) DEFAULT NULL,
                image varchar(255) DEFAULT NULL,
                view varchar(30) DEFAULT NULL,
                meta_title varchar(255) DEFAULT NULL,
                meta_keywords varchar(255) DEFAULT NULL,
                meta_description varchar(255) DEFAULT NULL,
                sort int(11) DEFAULT 0,
                enabled tinyint(1) DEFAULT 1,
                search tinyint(1) DEFAULT 1,
                PRIMARY KEY (id),
                UNIQUE INDEX catalog_category_name (name, root_id),
                UNIQUE INDEX catalog_category_nested (root_id, right_id, left_id, level)
            )
            ENGINE = INNODB
            AUTO_INCREMENT = 1
            CHARACTER SET utf8
            COLLATE utf8_general_ci;
        ");
	}

	public function down()
	{
        $this->dropTable('{{catalog_category}}');
        return true;
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