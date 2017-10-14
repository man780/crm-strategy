<?php

use yii\db\Migration;

/**
 * Handles adding percentage to table `event`.
 */
class m170602_154153_add_percentage_column_to_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%event}}', 'percentage', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%event}}', 'percentage');
    }
}
