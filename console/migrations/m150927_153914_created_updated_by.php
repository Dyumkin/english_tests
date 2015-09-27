<?php

use yii\db\Migration;

class m150927_153914_created_updated_by extends Migration
{
    public function up()
    {
        $this->addColumn('{{domain}}', 'created_by', $this->integer()->notNull());
        $this->addColumn('{{domain}}', 'updated_by', $this->integer()->notNull());

        $this->addColumn('{{level}}', 'created_by', $this->integer()->notNull());
        $this->addColumn('{{level}}', 'updated_by', $this->integer()->notNull());

        $this->addForeignKey('fk_domain_user', '{{domain}}', 'created_by', '{{user}}', 'id', 'RESTRICT');
        $this->addForeignKey('fk_domain_user_update', '{{domain}}', 'updated_by', '{{user}}', 'id', 'RESTRICT');

        $this->addForeignKey('fk_level_user', '{{level}}', 'created_by', '{{user}}', 'id', 'RESTRICT');
        $this->addForeignKey('fk_level_user_update', '{{level}}', 'updated_by', '{{user}}', 'id', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('fk_level_user_update', '{{level}}');
        $this->dropForeignKey('fk_level_user', '{{level}}');
        $this->dropForeignKey('fk_domain_user_update', '{{domain}}');
        $this->dropForeignKey('fk_domain_user', '{{domain}}');

        $this->dropColumn('level', 'created_by');
        $this->dropColumn('level', 'updated_by');

        $this->dropColumn('domain', 'created_by');
        $this->dropColumn('domain', 'updated_by');
    }

}
