<?php

use yii\db\Migration;

/**
 * Handles adding mechanism to table `event`.
 */
class m170608_071020_add_mechanism_column_to_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%event}}', 'mechanism', $this->string().'  AFTER `event` ');
        $this->addColumn('{{%event}}', 'status', $this->integer().'  AFTER `mechanism` ');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%event}}', 'mechanism');
        $this->dropColumn('{{%event}}', 'status');
    }
}
