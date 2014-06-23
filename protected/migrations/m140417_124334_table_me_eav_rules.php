<?php

class m140417_124334_table_me_eav_rules extends CDbMigration
{
    public function up()
    {
        $this->execute("
            CREATE TABLE {{eav_rules}} (
                id int(11) NOT NULL AUTO_INCREMENT,
                create_date timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                update_date timestamp NULL DEFAULT NULL,
                entity_id int(11) NOT NULL,
                attribute_id int(11) NOT NULL,
                name varchar(30) DEFAULT NULL,
                param varchar(50) DEFAULT NULL,
                value varchar(255) DEFAULT NULL,
                enabled tinyint(1) DEFAULT 1,
                PRIMARY KEY (id)
            )
            ENGINE = INNODB
            AUTO_INCREMENT = 1
            CHARACTER SET utf8
            COLLATE utf8_general_ci
            COMMENT = 'Таблица правил валидаций';
        ");
    }

    public function down()
    {
        $this->dropTable('{{eav_rules}}');
        return true;
    }
}