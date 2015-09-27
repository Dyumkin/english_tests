<?php

use yii\db\Migration;

class m150924_180036_questions extends Migration
{
    public function up()
    {
        $this->createTable('{{question}}', [
            'id' => $this->primaryKey(),
            'domain_id' => $this->integer()->notNull(),
            'type' => $this->string(255)->notNull(),
            'update_at' => $this->integer()->notNull(),
            'create_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull()
        ]);

        $this->createTable('{{question_simple}}', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer()->notNull(),
            'qlang_id' => $this->integer()->notNull(),
            'active' => $this->integer(1)->defaultValue(0),
            'difficult' => $this->integer()->defaultValue(0),
            'text' => $this->text()->notNull(),
            'options' => $this->text(),
            'correct' => $this->integer()->notNull(),
            'explanation' => $this->text()
        ]);

        $this->createTable('{{question_lang}}', [
            'id' => $this->primaryKey(),
            'iso' => $this->string(5)->notNull(),
            'local' => $this->string(255)->notNull(),
            'name' => $this->string(255)->notNull(),
        ]);

        $this->addForeignKey('fk_question_domain', '{{question}}', 'domain_id', '{{domain}}', 'id', 'RESTRICT');
        $this->addForeignKey('fk_question_simple', '{{question_simple}}', 'question_id', '{{question}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_question_user', '{{question}}', 'created_by', '{{user}}', 'id', 'RESTRICT');
        $this->addForeignKey('fk_question_user_update', '{{question}}', 'updated_by', '{{user}}', 'id', 'RESTRICT');
        $this->addForeignKey('fk_ques_simple_lang', '{{question_simple}}', 'qlang_id', '{{question_lang}}', 'id');

        $this->batchInsert('question_lang', ['iso', 'local', 'name'], [
            ['en', 'en-EN', 'English']
        ]);
    }

    public function down()
    {
        $this->dropForeignKey('fk_ques_simple_lang', '{{question_simple}}');
        $this->dropForeignKey('fk_question_user_update', '{{question}}');
        $this->dropForeignKey('fk_question_user', '{{question}}');
        $this->dropForeignKey('fk_question_domain', '{{question}}');
        $this->dropForeignKey('fk_question_simple', '{{question_simple}}');
        $this->dropTable('{{question_lang}}');
        $this->dropTable('{{question_simple}}');
        $this->dropTable('{{question}}');
    }

}
