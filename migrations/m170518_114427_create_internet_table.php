<?php

use yii\db\Migration;

/**
 * Handles the creation of table `internet`.
 */
class m170518_114427_create_internet_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%internet}}', [
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
        $this->dropTable('{{%internet}}');
    }
}
