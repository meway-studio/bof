<?php

class m140416_124810_table_me_eav_attribute extends CDbMigration
{
	public function up()
	{
        $this->execute("
            CREATE TABLE {{eav_attribute}} (
                id int(11) NOT NULL AUTO_INCREMENT,
                create_date timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                update_date timestamp NULL DEFAULT NULL,
                name varchar(100) DEFAULT NULL COMMENT 'Название',
                label varchar(255) DEFAULT NULL COMMENT 'Ярлык',
                hint varchar(255) DEFAULT NULL COMMENT 'Подсказка',
                type varchar(255) DEFAULT NULL COMMENT 'Тип',
                many tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Множественное значение',
                options text DEFAULT NULL COMMENT 'Опции (для формы это html опции)',
                sort int(11) DEFAULT 0 COMMENT 'Сортировка (вес)',
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
        $this->dropTable('{{eav_attribute}}');
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