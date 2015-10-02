<?php

use yii\db\Migration;

class m151002_162449_question_multi_choice extends Migration
{
    public function up()
    {
        $this->createTable('{{question_multiple_choice}}', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer()->notNull(),
            'qlang_id' => $this->integer()->notNull(),
            'active' => $this->smallInteger(1)->defaultValue(0),
            'difficult' => $this->integer()->defaultValue(0),
            'text' => $this->text()->notNull(),
            'options' => $this->text(),
            'correct' => $this->text(),
            'explanation' => $this->text()
        ]);

        $this->addForeignKey('fk_question_multi', '{{question_multiple_choice}}', 'question_id', '{{question}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_ques_multi_lang', '{{question_multiple_choice}}', 'qlang_id', '{{question_lang}}', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('fk_question_multi', '{{question_multiple_choice}}');
        $this->dropForeignKey('fk_ques_multi_lang', '{{question_multiple_choice}}');
        $this->dropTable('{{question_multiple_choice}}');
    }
}
