<?php

use yii\db\Migration;

class m150927_141529_user_role extends Migration
{
    public function up()
    {
        $this->addColumn('{{user}}', 'role', $this->string(255));
    }

    public function down()
    {
        $this->dropColumn('{{user}}', 'role');
    }

}
