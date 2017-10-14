<?php

use yii\db\Migration;

/**
 * Handles the creation of table `event_executor_authority`.
 * Has foreign keys to the tables:
 *
 * - `event`
 * - `executor_authority`
 */
class m170513_084430_create_junction_table_for_event_and_executor_authority_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%event_executor_authority}}', [
            'event_id' => $this->integer(),
            'executor_authority_id' => $this->integer(),
            'sequence_exec' => $this->integer(),
            'created_at' => $this->integer(),
            //'PRIMARY KEY(event_id, executor_authority_id)',
        ]);

        // creates index for column `event_id`
        $this->createIndex(
            'idx-event_executor_authority-event_id',
            '{{%event_executor_authority}}',
            'event_id'
        );

        // add foreign key for table `event`
        $this->addForeignKey(
            'fk-event_executor_authority-event_id',
            '{{%event_executor_authority}}',
            'event_id',
            '{{%event}}',
            'id',
            'CASCADE'
        );

        // creates index for column `executor_authority_id`
        $this->createIndex(
            'idx-event_executor_authority-executor_authority_id',
            '{{%event_executor_authority}}',
            'executor_authority_id'
        );

        // add foreign key for table `executor_authority`
        $this->addForeignKey(
            'fk-event_executor_authority-executor_authority_id',
            '{{%event_executor_authority}}',
            'executor_authority_id',
            '{{%executor_authority}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `event`
        $this->dropForeignKey(
            'fk-event_executor_authority-event_id',
            '{{%event_executor_authority}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            'idx-event_executor_authority-event_id',
            '{{%event_executor_authority}}'
        );

        // drops foreign key for table `executor_authority`
        $this->dropForeignKey(
            'fk-event_executor_authority-executor_authority_id',
            '{{%event_executor_authority}}'
        );

        // drops index for column `executor_authority_id`
        $this->dropIndex(
            'idx-event_executor_authority-executor_authority_id',
            '{{%event_executor_authority}}'
        );

        $this->dropTable('{{%event_executor_authority}}');
    }
}
