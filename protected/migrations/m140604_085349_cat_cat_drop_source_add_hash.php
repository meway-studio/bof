<?php

class m140604_085349_cat_cat_drop_source_add_hash extends CDbMigration
{
    public function up()
    {
        $this->dropColumn( "{{catalog_category}}", 'source' );
        $this->addColumn( "{{catalog_category}}", 'hash', 'VARCHAR(50) DEFAULT NULL AFTER id' );
    }

    public function down()
    {
        $this->dropColumn( "{{catalog_category}}", 'hash' );
        $this->addColumn( "{{catalog_category}}", 'source', 'LONGTEXT DEFAULT NULL' );
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