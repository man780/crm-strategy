<?php

use yii\db\Migration;

/**
 * Handles adding num to table `sub_direction`.
 */
class m170515_075858_add_num_column_to_sub_direction_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%sub_direction}}', 'num', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%sub_direction}}', 'num');
    }
}
