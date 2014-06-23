<?php

class m140416_124748_table_me_eav_value extends CDbMigration
{
	public function up()
	{
        $this->execute("
            CREATE TABLE {{eav_value}} (
                id int(11) NOT NULL AUTO_INCREMENT,
                create_date timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                update_date timestamp NULL DEFAULT NULL,
                entity_id int(11) NOT NULL COMMENT 'ID сущности',
                attribute_id int(11) NOT NULL COMMENT 'ID аттрибута',
                element_id int(11) DEFAULT NULL COMMENT 'ID элемента сущности',
                value text DEFAULT NULL COMMENT 'Значение',
                PRIMARY KEY (id)
            )
            ENGINE = INNODB
            AUTO_INCREMENT = 1
            CHARACTER SET utf8
            COLLATE utf8_general_ci
            COMMENT = 'Таблица значений атрибутов';
        ");
	}

    public function down()
    {
        $this->dropTable('{{eav_value}}');
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