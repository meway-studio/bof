<?php

class m140507_102252_catalogelement_columns_draft_published_active extends CDbMigration
{
    public function up()
    {
        try {
            $this->execute("
                ALTER TABLE {{catalog_element}}
                ADD COLUMN draft TINYINT(1) NOT NULL DEFAULT 1 AFTER meta_description,
                ADD COLUMN published TINYINT(1) NOT NULL DEFAULT 0 AFTER draft,
                ADD COLUMN active TINYINT(1) NOT NULL DEFAULT 1 AFTER published;
            ");
        } catch (Exception $e) {}

    }

    public function down()
    {
        $table = "{{catalog_element}}";
        try {
            $this->dropColumn($table, 'draft');
            $this->dropColumn($table, 'published');
            $this->dropColumn($table, 'active');
        } catch (Exception $e) {}
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