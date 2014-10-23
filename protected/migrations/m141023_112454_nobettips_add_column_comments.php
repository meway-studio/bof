<?php

class m141023_112454_nobettips_add_column_comments extends CDbMigration
{
    public function up()
    {
        $this->execute(
            "
              ALTER TABLE {{nobettips}}
              ADD COLUMN comments TINYINT(1) DEFAULT NULL AFTER meta_d;
            "
        );
    }

    public function down()
    {
        $this->dropColumn( '{{nobettips}}', 'comments' );
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