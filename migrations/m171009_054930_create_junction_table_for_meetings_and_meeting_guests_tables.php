<?php

use yii\db\Migration;

/**
 * Handles the creation of table `meetings_meeting_guests`.
 * Has foreign keys to the tables:
 *
 * - `meetings`
 * - `meeting_guests`
 */
class m171009_054930_create_junction_table_for_meetings_and_meeting_guests_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%meetings_meeting_guests}}', [
            'meetings_id' => $this->integer(),
            'meeting_guests_id' => $this->integer(),
            'PRIMARY KEY(meetings_id, meeting_guests_id)',
        ]);

        // creates index for column `meetings_id`
        $this->createIndex(
            'idx-meetings_meeting_guests-meetings_id',
            '{{%meetings_meeting_guests}}',
            'meetings_id'
        );

        // add foreign key for table `meetings`
        $this->addForeignKey(
            'fk-meetings_meeting_guests-meetings_id',
            '{{%meetings_meeting_guests}}',
            'meetings_id',
            '{{%meetings}}',
            'id',
            'CASCADE'
        );

        // creates index for column `meeting_guests_id`
        $this->createIndex(
            'idx-meetings_meeting_guests-meeting_guests_id',
            '{{%meetings_meeting_guests}}',
            'meeting_guests_id'
        );

        // add foreign key for table `meeting_guests`
        $this->addForeignKey(
            'fk-meetings_meeting_guests-meeting_guests_id',
            '{{%meetings_meeting_guests}}',
            'meeting_guests_id',
            '{{%meeting_guests}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `meetings`
        $this->dropForeignKey(
            'fk-meetings_meeting_guests-meetings_id',
            '{{%meetings_meeting_guests}}'
        );

        // drops index for column `meetings_id`
        $this->dropIndex(
            'idx-meetings_meeting_guests-meetings_id',
            '{{%meetings_meeting_guests}}'
        );

        // drops foreign key for table `meeting_guests`
        $this->dropForeignKey(
            'fk-meetings_meeting_guests-meeting_guests_id',
            '{{%meetings_meeting_guests}}'
        );

        // drops index for column `meeting_guests_id`
        $this->dropIndex(
            'idx-meetings_meeting_guests-meeting_guests_id',
            '{{%meetings_meeting_guests}}'
        );

        $this->dropTable('{{%meetings_meeting_guests}}');
    }
}
