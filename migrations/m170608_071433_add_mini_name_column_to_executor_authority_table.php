<?php

use yii\db\Migration;

/**
 * Handles adding mini_name to table `event_executor_authority`.
 */
class m170608_071433_add_mini_name_column_to_executor_authority_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%executor_authority}}', 'mini_name', $this->string(). ' AFTER `id`');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%event_executor_authority}}', 'mni_name');
    }
}
