<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tv`.
 */
class m170518_114323_create_tv_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%tv}}', [
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
        $this->dropTable('{{%tv}}');
    }
}
