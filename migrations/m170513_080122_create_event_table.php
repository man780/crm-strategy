<?php

use yii\db\Migration;

/**
 * Handles the creation of table `event`.
 * Has foreign keys to the tables:
 *
 * - `direction`
 * - `sub_direction`
 */
class m170513_080122_create_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'direction_id' => $this->integer()->notNull(),
            'sub_dir_id' => $this->integer()->notNull(),
            'event' => $this->text(),
            'details' => $this->text(),
            'deadline' => $this->integer(),
            'deadline_other' => $this->string(),
        ]);

        // creates index for column `direction_id`
        $this->createIndex(
            'idx-event-direction_id',
            '{{%event}}',
            'direction_id'
        );

        // add foreign key for table `direction`
        $this->addForeignKey(
            'fk-event-direction_id',
            '{{%event}}',
            'direction_id',
            '{{%direction}}',
            'id',
            'CASCADE'
        );

        // creates index for column `sub_dir_id`
        $this->createIndex(
            'idx-event-sub_dir_id',
            '{{%event}}',
            'sub_dir_id'
        );

        // add foreign key for table `sub_direction`
        $this->addForeignKey(
            'fk-event-sub_dir_id',
            '{{%event}}',
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
        // drops foreign key for table `direction`
        $this->dropForeignKey(
            'fk-event-direction_id',
            '{{%event}}'
        );

        // drops index for column `direction_id`
        $this->dropIndex(
            'idx-event-direction_id',
            '{{%event}}'
        );

        // drops foreign key for table `sub_direction`
        $this->dropForeignKey(
            'fk-event-sub_dir_id',
            '{{%event}}'
        );

        // drops index for column `sub_dir_id`
        $this->dropIndex(
            'idx-event-sub_dir_id',
            '{{%event}}'
        );

        $this->dropTable('{{%event}}');
    }
}
