<?php

use yii\db\Migration;

/**
 * Handles adding link to table `broadcasting_internet`.
 */
class m170602_140452_add_link_column_to_broadcasting_internet_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%broadcasting_internet}}', 'link', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%broadcasting_internet}}', 'link');
    }
}
