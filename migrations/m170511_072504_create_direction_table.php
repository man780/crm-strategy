<?php

use yii\db\Migration;

/**
 * Handles the creation of table `direction`.
 */
class m170511_072504_create_direction_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%direction}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'image' => $this->string(255),
            'color' => $this->string(8),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%direction}}');
    }
}
