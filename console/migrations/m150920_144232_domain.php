<?php

use yii\db\Migration;

class m150920_144232_domain extends Migration
{
    public function up()
    {
        $this->createTable('{{domain}}', [
            'id' => $this->primaryKey(),
            'domain_id' => $this->integer(),
            'level_id' => $this->integer(),
            'update_at' => $this->integer()->notNull(),
            'create_at' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'status' => $this->integer(1)->notNull()->defaultValue(0),
            'is_trial' => $this->integer(1)->notNull()->defaultValue(0),
            'timer' => $this->integer()->notNull()->defaultValue(0)
        ]);

        $this->createTable('{{domain_I18N}}', [
            'id' => $this->primaryKey(),
            'domain_id' => $this->integer()->notNull(),
            'lang_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text()
        ]);

        $this->addForeignKey('fk_domain_level', '{{domain}}', 'level_id', '{{level}}', 'id', 'RESTRICT');
        $this->addForeignKey('fk_domain_i18n', '{{domain_I18N}}', 'domain_id', '{{domain}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_domain_domain', '{{domain}}', 'domain_id', '{{domain}}', 'id');
        $this->addForeignKey('fk_domain_lang', '{{domain_I18N}}', 'lang_id', '{{lang}}', 'id', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('fk_domain_level', '{{domain}}');
        $this->dropForeignKey('fk_domain_lang', '{{domain_I18N}}');
        $this->dropForeignKey('fk_domain_domain', '{{domain}}');
        $this->dropForeignKey('fk_domain_i18n', '{{domain_I18N}}');
        $this->dropTable('{{domain}}');
        $this->dropTable('{{domain_I18N}}');
    }

}
