<?php

use yii\db\Migration;

/**
 * Handles the creation of table `meetings`.
 */
class m171009_054254_create_meetings_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%meetings}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'text' => $this->text(),
            'place' => $this->text(),
            'time' => $this->integer(),
            'type' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%meetings}}');
    }
}
