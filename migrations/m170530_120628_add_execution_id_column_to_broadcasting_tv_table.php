<?php

use yii\db\Migration;

/**
 * Handles adding execution_id to table `broadcasting_tv`.
 * Has foreign keys to the tables:
 *
 * - `execution`
 */
class m170530_120628_add_execution_id_column_to_broadcasting_tv_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%broadcasting_tv}}', 'execution_id', $this->integer()->notNull());

        // creates index for column `execution_id`
        $this->createIndex(
            'idx-broadcasting_tv-execution_id',
            '{{%broadcasting_tv}}',
            'execution_id'
        );

        // add foreign key for table `execution`
        $this->addForeignKey(
            'fk-broadcasting_tv-execution_id',
            '{{%broadcasting_tv}}',
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
            'fk-broadcasting_tv-execution_id',
            '{{%broadcasting_tv}}'
        );

        // drops index for column `execution_id`
        $this->dropIndex(
            'idx-broadcasting_tv-execution_id',
            '{{%broadcasting_tv}}'
        );

        $this->dropColumn('{{%broadcasting_tv}}', 'execution_id');
    }
}
