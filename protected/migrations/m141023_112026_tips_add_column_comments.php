<?php

class m141023_112026_tips_add_column_comments extends CDbMigration
{
    public function up()
    {
        $this->execute(
            "
              ALTER TABLE {{tips}}
              ADD COLUMN comments TINYINT(1) DEFAULT NULL AFTER meta_d;
            "
        );
    }

    public function down()
    {
        $this->dropColumn( '{{tips}}', 'comments' );
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