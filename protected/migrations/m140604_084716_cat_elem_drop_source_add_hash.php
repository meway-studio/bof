<?php

class m140604_084716_cat_elem_drop_source_add_hash extends CDbMigration
{
    public function up()
    {
        $this->dropColumn( "{{catalog_element}}", 'source' );
        $this->addColumn( "{{catalog_element}}", 'hash', 'VARCHAR(50) DEFAULT NULL AFTER category_id' );
        $this->addColumn( "{{catalog_element}}", 'article', 'VARCHAR(50) DEFAULT NULL AFTER title' );
    }

    public function down()
    {
        $this->dropColumn( "{{catalog_element}}", 'hash' );
        $this->dropColumn( "{{catalog_element}}", 'article' );
        $this->addColumn( "{{catalog_element}}", 'source', 'LONGTEXT DEFAULT NULL' );
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