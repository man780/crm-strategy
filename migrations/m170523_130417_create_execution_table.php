<?php

use yii\db\Migration;

/**
 * Handles the creation of table `execution`.
 * Has foreign keys to the tables:
 *
 * - `st_executor_authority`
 * - `st_executor_staff`
 * - `st_direction`
 * - `st_sub_direction`
 * - `st_event`
 */
class m170523_130417_create_execution_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%execution}}', [
            'id' => $this->primaryKey(),
            'exec_id' => $this->integer()->notNull(),
            'exec_staff_id' => $this->integer()->notNull(),
            'direction_id' => $this->integer()->notNull(),
            'sub_dir_id' => $this->integer()->notNull(),
            'event_id' => $this->integer()->notNull(),
            'actual_mastering_finance' => $this->integer()->null(),
            'timely_financial_security' => $this->integer()->null(),
            'persentage' => $this->integer()->null(),
            'execution_information' => $this->text(),
            'factors_preventing_implementation' => $this->text(),
            'seen' => $this->integer(1)->null(),
            'bycreated' => $this->integer(11),
            'dcreated' => $this->integer(11),
            'bydeleted' => $this->integer(11),
            'ddeleted' => $this->integer(11),
        ]);

        // creates index for column `exec_id`
        $this->createIndex(
            'idx-execution-exec_id',
            '{{%execution}}',
            'exec_id'
        );

        // add foreign key for table `st_executor_authority`
        $this->addForeignKey(
            'fk-execution-exec_id',
            '{{%execution}}',
            'exec_id',
            '{{%executor_authority}}',
            'id',
            'CASCADE'
        );

        // creates index for column `exec_staff_id`
        $this->createIndex(
            'idx-execution-exec_staff_id',
            '{{%execution}}',
            'exec_staff_id'
        );

        // add foreign key for table `st_executor_staff`
        $this->addForeignKey(
            'fk-execution-exec_staff_id',
            '{{%execution}}',
            'exec_staff_id',
            '{{%executor_staff}}',
            'id',
            'CASCADE'
        );

        // creates index for column `direction_id`
        $this->createIndex(
            'idx-execution-direction_id',
            '{{%execution}}',
            'direction_id'
        );

        // add foreign key for table `st_direction`
        $this->addForeignKey(
            'fk-execution-direction_id',
            '{{%execution}}',
            'direction_id',
            '{{%direction}}',
            'id',
            'CASCADE'
        );

        // creates index for column `sub_dir_id`
        $this->createIndex(
            'idx-execution-sub_dir_id',
            '{{%execution}}',
            'sub_dir_id'
        );

        // add foreign key for table `st_sub_direction`
        $this->addForeignKey(
            'fk-execution-sub_dir_id',
            '{{%execution}}',
            'sub_dir_id',
            '{{%sub_direction}}',
            'id',
            'CASCADE'
        );

        // creates index for column `event_id`
        $this->createIndex(
            'idx-execution-event_id',
            '{{%execution}}',
            'event_id'
        );

        // add foreign key for table `st_event`
        $this->addForeignKey(
            'fk-execution-event_id',
            '{{%execution}}',
            'event_id',
            '{{%event}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `st_executor_authority`
        $this->dropForeignKey(
            'fk-execution-exec_id',
            '{{%execution}}'
        );

        // drops index for column `exec_id`
        $this->dropIndex(
            'idx-execution-exec_id',
            '{{%execution}}'
        );

        // drops foreign key for table `st_executor_staff`
        $this->dropForeignKey(
            'fk-execution-exec_staff_id',
            '{{%execution}}'
        );

        // drops index for column `exec_staff_id`
        $this->dropIndex(
            'idx-execution-exec_staff_id',
            '{{%execution}}'
        );

        // drops foreign key for table `st_direction`
        $this->dropForeignKey(
            'fk-execution-direction_id',
            '{{%execution}}'
        );

        // drops index for column `direction_id`
        $this->dropIndex(
            'idx-execution-direction_id',
            '{{%execution}}'
        );

        // drops foreign key for table `st_sub_direction`
        $this->dropForeignKey(
            'fk-execution-sub_dir_id',
            '{{%execution}}'
        );

        // drops index for column `sub_dir_id`
        $this->dropIndex(
            'idx-execution-sub_dir_id',
            '{{%execution}}'
        );

        // drops foreign key for table `st_event`
        $this->dropForeignKey(
            'fk-execution-event_id',
            '{{%execution}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            'idx-execution-event_id',
            '{{%execution}}'
        );

        $this->dropTable('{{%execution}}');
    }
}
