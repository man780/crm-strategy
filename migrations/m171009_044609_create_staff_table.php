<?php

use yii\db\Migration;

/**
 * Handles the creation of table `staff`.
 */
class m171009_044609_create_staff_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%staff}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'position' => $this->string(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%staff}}');
    }
}
