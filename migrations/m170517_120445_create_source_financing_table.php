<?php

use yii\db\Migration;

/**
 * Handles the creation of table `source_financing`.
 */
class m170517_120445_create_source_financing_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%source_financing}}', [
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
        $this->dropTable('{{%source_financing}}');
    }
}
