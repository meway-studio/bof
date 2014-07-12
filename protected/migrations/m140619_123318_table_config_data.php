<?php

class m140619_123318_table_config_data extends CDbMigration
{
    public function up()
    {
        try {
            $this->execute("
                INSERT INTO {{config}} (`param`, `value`, `default`, `label`, `type`) VALUES
                ('SYS_CACHE_TIME', '0', '86400', 'Cache lifetime', '');
            ");
        } catch ( Exception $e ) {
        }
    }

    public function down()
    {
        echo "m140619_123318_table_config_data does not support migration down.\n";
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