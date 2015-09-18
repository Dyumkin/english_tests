<?php

use yii\db\Migration;

class m150915_190628_level extends Migration
{
    public function up()
    {

        $this->createTable('{{level}}', [
            'id' => $this->primaryKey(),
            'date_update' => $this->integer()->notNull(),
            'date_create' => $this->integer()->notNull()
        ]);

        $this->createTable('{{level_I18N}}', [
            'id' => $this->primaryKey(),
            'level_id' => $this->integer()->notNull(),
            'lang_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text()
        ]);

        $this->addForeignKey('fk_level_i18n', '{{level_I18N}}', 'level_id', '{{level}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_level_lang', '{{level_I18N}}', 'lang_id', '{{lang}}', 'id', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('fk_level_lang', '{{level_I18N}}');
        $this->dropForeignKey('fk_level_i18n', '{{level_I18N}}');
        $this->dropTable('{{level}}');
        $this->dropTable('{{level_I18N}}');
    }
}
