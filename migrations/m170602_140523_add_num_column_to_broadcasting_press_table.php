<?php

use yii\db\Migration;

/**
 * Handles adding num to table `broadcasting_press`.
 */
class m170602_140523_add_num_column_to_broadcasting_press_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%broadcasting_press}}', 'num', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%broadcasting_press}}', 'num');
    }
}
