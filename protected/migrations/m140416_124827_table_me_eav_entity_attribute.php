<?php

class m140416_124827_table_me_eav_entity_attribute extends CDbMigration
{
	public function up()
	{
        $this->execute("
            CREATE TABLE {{eav_entity_attribute}} (
                id int(11) NOT NULL AUTO_INCREMENT,
                create_date timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                update_date timestamp NULL DEFAULT NULL,
                entity_id int(11) DEFAULT NULL COMMENT 'ID сущности',
                attribute_id int(11) DEFAULT NULL COMMENT 'ID атрибута',
                sort int(11) DEFAULT 0,
                PRIMARY KEY (id)
            )
            ENGINE = INNODB
            AUTO_INCREMENT = 1
            CHARACTER SET utf8
            COLLATE utf8_general_ci
            COMMENT = 'Связующая таблица. Атрибуты сущности';
        ");
	}

    public function down()
    {
        $this->dropTable('{{eav_entity_attribute}}');
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