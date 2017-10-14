<?php

use yii\db\Migration;

/**
 * Handles adding execution_id to table `broadcasting_press`.
 * Has foreign keys to the tables:
 *
 * - `execution`
 */
class m170530_120736_add_execution_id_column_to_broadcasting_press_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%broadcasting_press}}', 'execution_id', $this->integer()->notNull());

        // creates index for column `execution_id`
        $this->createIndex(
            'idx-broadcasting_press-execution_id',
            '{{%broadcasting_press}}',
            'execution_id'
        );

        // add foreign key for table `execution`
        $this->addForeignKey(
            'fk-broadcasting_press-execution_id',
            '{{%broadcasting_press}}',
            'execution_id',
            '{{%execution}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `execution`
        $this->dropForeignKey(
            'fk-broadcasting_press-execution_id',
            '{{%broadcasting_press}}'
        );

        // drops index for column `execution_id`
        $this->dropIndex(
            'idx-broadcasting_press-execution_id',
            '{{%broadcasting_press}}'
        );

        $this->dropColumn('{{%broadcasting_press}}', 'execution_id');
    }
}
