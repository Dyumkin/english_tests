<?php

use yii\db\Migration;

class m150915_190628_level extends Migration
{
    public function up()
    {

        $this->createTable('{{level}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{level}}');
    }
}
