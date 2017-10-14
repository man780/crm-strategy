<?php

use yii\db\Migration;

/**
 * Handles the creation of table `radio`.
 */
class m170518_114341_create_radio_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%radio}}', [
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
        $this->dropTable('{{%radio}}');
    }
}
