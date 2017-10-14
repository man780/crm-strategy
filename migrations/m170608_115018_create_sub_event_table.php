<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sub_event`.
 * Has foreign keys to the tables:
 *
 * - `event`
 * - `direction`
 * - `sub_direction`
 */
class m170608_115018_create_sub_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%sub_event}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'direction_id' => $this->integer()->notNull(),
            'sub_dir_id' => $this->integer()->defaultValue(1),
            'event' => $this->string(),
            'mechanism' => $this->string(),
            'details' => $this->text(),
            'deadline' => $this->integer(),
            'deadline_other' => $this->string(),
            'percentage' => $this->integer(),
            'status' => $this->integer(),
        ]);

        // creates index for column `event_id`
        $this->createIndex(
            'idx-sub_event-event_id',
            '{{%sub_event}}',
            'event_id'
        );

        // add foreign key for table `event`
        $this->addForeignKey(
            'fk-sub_event-event_id',
            '{{%sub_event}}',
            'event_id',
            '{{%event}}',
            'id',
            'CASCADE'
        );

        // creates index for column `direction_id`
        $this->createIndex(
            'idx-sub_event-direction_id',
            '{{%sub_event}}',
            'direction_id'
        );

        // add foreign key for table `direction`
        $this->addForeignKey(
            'fk-sub_event-direction_id',
            '{{%sub_event}}',
            'direction_id',
            '{{%direction}}',
            'id',
            'CASCADE'
        );

        // creates index for column `sub_dir_id`
        $this->createIndex(
            'idx-sub_event-sub_dir_id',
            '{{%sub_event}}',
            'sub_dir_id'
        );

        // add foreign key for table `sub_direction`
        $this->addForeignKey(
            'fk-sub_event-sub_dir_id',
            '{{%sub_event}}',
            'sub_dir_id',
            '{{%sub_direction}}',
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
            'fk-sub_event-event_id',
            '{{%sub_event}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            'idx-sub_event-event_id',
            '{{%sub_event}}'
        );

        // drops foreign key for table `direction`
        $this->dropForeignKey(
            'fk-sub_event-direction_id',
            '{{%sub_event}}'
        );

        // drops index for column `direction_id`
        $this->dropIndex(
            'idx-sub_event-direction_id',
            '{{%sub_event}}'
        );

        // drops foreign key for table `sub_direction`
        $this->dropForeignKey(
            'fk-sub_event-sub_dir_id',
            '{{%sub_event}}'
        );

        // drops index for column `sub_dir_id`
        $this->dropIndex(
            'idx-sub_event-sub_dir_id',
            '{{%sub_event}}'
        );

        $this->dropTable('{{%sub_event}}');
    }
}
