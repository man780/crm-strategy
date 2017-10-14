<?php

use yii\db\Migration;

/**
 * Handles the creation of table `executor_authority`.
 */
class m170513_083737_create_executor_authority_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%executor_authority}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text(),
            'details' => $this->text(),
            'phones' => $this->string(),
            'emails' => $this->string(),
            'address' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%executor_authority}}');
    }
}
