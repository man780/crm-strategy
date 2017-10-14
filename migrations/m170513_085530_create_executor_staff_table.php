<?php

use yii\db\Migration;

/**
 * Handles the creation of table `executor_staff`.
 * Has foreign keys to the tables:
 *
 * - `executor_authority`
 */
class m170513_085530_create_executor_staff_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%executor_staff}}', [
            'id' => $this->primaryKey(),
            'exec_id' => $this->integer(),
            'fio' => $this->string(),
            'details' => $this->text(),
            'phones' => $this->string(),
            'emails' => $this->string(),
        ]);

        // creates index for column `exec_id`
        $this->createIndex(
            'idx-executor_staff-exec_id',
            '{{%executor_staff}}',
            'exec_id'
        );

        // add foreign key for table `executor_authority`
        $this->addForeignKey(
            'fk-executor_staff-exec_id',
            '{{%executor_staff}}',
            'exec_id',
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
        // drops foreign key for table `executor_authority`
        $this->dropForeignKey(
            'fk-executor_staff-exec_id',
            '{{%executor_staff}}'
        );

        // drops index for column `exec_id`
        $this->dropIndex(
            'idx-executor_staff-exec_id',
            '{{%executor_staff}}'
        );

        $this->dropTable('{{%executor_staff}}');
    }
}
