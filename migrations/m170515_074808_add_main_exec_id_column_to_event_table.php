<?php

use yii\db\Migration;

/**
 * Handles adding main_exec_id to table `event`.
 */
class m170515_074808_add_main_exec_id_column_to_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%event}}', 'main_exec_id', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%event}}', 'main_exec_id');
    }
}
