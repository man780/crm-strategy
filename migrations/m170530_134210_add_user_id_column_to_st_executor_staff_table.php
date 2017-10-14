<?php

use yii\db\Migration;

/**
 * Handles adding user_id to table `st_executor_staff`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m170530_134210_add_user_id_column_to_st_executor_staff_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%executor_staff}}', 'user_id', $this->integer()->notNull());

        // creates index for column `user_id`
        $this->createIndex(
            'idx-st_executor_staff-user_id',
            '{{%executor_staff}}',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-st_executor_staff-user_id',
            '{{%executor_staff}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-st_executor_staff-user_id',
            '{{%executor_staff}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-st_executor_staff-user_id',
            '{{%executor_staff}}'
        );

        $this->dropColumn('{{%executor_staff}}', 'user_id');
    }
}
