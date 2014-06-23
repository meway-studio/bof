<?php

class m140416_124711_table_me_eav_entity extends CDbMigration
{
	public function up()
	{
        $this->execute("
            CREATE TABLE {{eav_entity}} (
                id int(11) NOT NULL AUTO_INCREMENT,
                create_date timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                update_date timestamp NULL DEFAULT NULL,
                type enum ('model', 'form') DEFAULT 'model' COMMENT 'Тип',
                name varchar(50) DEFAULT NULL COMMENT 'Название',
                `optimize` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Оптимизировать (для модели создается view в БД)',
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
		$this->dropTable('{{eav_entity}}');
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