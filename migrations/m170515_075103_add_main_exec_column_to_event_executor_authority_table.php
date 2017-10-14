<?php

use yii\db\Migration;

/**
 * Handles adding main_exec to table `event_executor_authority`.
 */
class m170515_075103_add_main_exec_column_to_event_executor_authority_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%event_executor_authority}}', 'sequence_exec', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%event_executor_authority}}', 'sequence_exec');
    }
}
