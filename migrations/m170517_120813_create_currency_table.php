<?php

use yii\db\Migration;

/**
 * Handles the creation of table `currency`.
 */
class m170517_120813_create_currency_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%currency}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'details' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%currency}}');
    }
}
