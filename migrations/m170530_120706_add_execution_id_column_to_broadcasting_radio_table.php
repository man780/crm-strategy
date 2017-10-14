<?php

use yii\db\Migration;

/**
 * Handles adding execution_id to table `broadcasting_radio`.
 * Has foreign keys to the tables:
 *
 * - `execution`
 */
class m170530_120706_add_execution_id_column_to_broadcasting_radio_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%broadcasting_radio}}', 'execution_id', $this->integer()->notNull());

        // creates index for column `execution_id`
        $this->createIndex(
            'idx-broadcasting_radio-execution_id',
            '{{%broadcasting_radio}}',
            'execution_id'
        );

        // add foreign key for table `execution`
        $this->addForeignKey(
            'fk-broadcasting_radio-execution_id',
            '{{%broadcasting_radio}}',
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
            'fk-broadcasting_radio-execution_id',
            '{{%broadcasting_radio}}'
        );

        // drops index for column `execution_id`
        $this->dropIndex(
            'idx-broadcasting_radio-execution_id',
            '{{%broadcasting_radio}}'
        );

        $this->dropColumn('{{%broadcasting_radio}}', 'execution_id');
    }
}
