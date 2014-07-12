<?php

class m140624_121020_change_catalog_order extends CDbMigration
{
    public function up()
    {
        try {
            $this->execute("
                ALTER TABLE {{catalog_order}}
                DROP COLUMN user_name,
                DROP COLUMN user_email,
                DROP COLUMN user_address,
                DROP COLUMN user_phone,
                CHANGE COLUMN delivery delivery_id INT(11) DEFAULT 0 AFTER comment,
                CHANGE COLUMN status status_id INT(11) DEFAULT 0 AFTER delivery_id,
                ADD COLUMN active TINYINT(1) NOT NULL DEFAULT 1 AFTER status_id;
            ");
        } catch ( Exception $e ) {
        }
    }

    public function down()
    {
        echo "m140624_121020_change_catalog_order does not support migration down.\n";
        return false;
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