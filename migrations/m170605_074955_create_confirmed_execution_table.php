<?php

use yii\db\Migration;

/**
 * Handles the creation of table `confirmed_execution`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `execution`
 */
class m170605_074955_create_confirmed_execution_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%confirmed_execution}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'execution_id' => $this->integer()->defaultValue(1),
            'event_id' => $this->integer()->defaultValue(1),
            'dcreated' => $this->integer(),
            'note' => $this->text(),
            'new_execution_information' => $this->text(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-confirmed_execution-user_id',
            '{{%confirmed_execution}}',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-confirmed_execution-user_id',
            '{{%confirmed_execution}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `execution_id`
        $this->createIndex(
            'idx-confirmed_execution-execution_id',
            '{{%confirmed_execution}}',
            'execution_id'
        );

        // add foreign key for table `execution`
        $this->addForeignKey(
            'fk-confirmed_execution-execution_id',
            '{{%confirmed_execution}}',
            'execution_id',
            '{{%execution}}',
            'id',
            'CASCADE'
        );

        // creates index for column `event_id`
        $this->createIndex(
            'idx-confirmed_execution-event_id',
            '{{%confirmed_execution}}',
            'event_id'
        );

        // add foreign key for table `event`
        $this->addForeignKey(
            'fk-confirmed_execution-event_id',
            '{{%confirmed_execution}}',
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
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-confirmed_execution-user_id',
            '{{%confirmed_execution}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-confirmed_execution-user_id',
            '{{%confirmed_execution}}'
        );

        // drops foreign key for table `execution`
        $this->dropForeignKey(
            'fk-confirmed_execution-execution_id',
            '{{%confirmed_execution}}'
        );

        // drops index for column `execution_id`
        $this->dropIndex(
            'idx-confirmed_execution-execution_id',
            '{{%confirmed_execution}}'
        );

        // drops foreign key for table `event`
        $this->dropForeignKey(
            'fk-confirmed_execution-event_id',
            '{{%confirmed_execution}}'
        );
        // drops index for column `event_id`
        $this->dropIndex(
            'idx-confirmed_execution-event_id',
            '{{%confirmed_execution}}'
        );

        $this->dropTable('{{%confirmed_execution}}');
    }
}
