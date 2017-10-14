<?php

use yii\db\Migration;

/**
 * Handles the creation of table `meetings_staff`.
 * Has foreign keys to the tables:
 *
 * - `meetings`
 * - `staff`
 */
class m171009_054848_create_junction_table_for_meetings_and_staff_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%meetings_staff}}', [
            'meetings_id' => $this->integer(),
            'staff_id' => $this->integer(),
            'PRIMARY KEY(meetings_id, staff_id)',
        ]);

        // creates index for column `meetings_id`
        $this->createIndex(
            'idx-meetings_staff-meetings_id',
            '{{%meetings_staff}}',
            'meetings_id'
        );

        // add foreign key for table `meetings`
        $this->addForeignKey(
            'fk-meetings_staff-meetings_id',
            '{{%meetings_staff}}',
            'meetings_id',
            '{{%meetings}}',
            'id',
            'CASCADE'
        );

        // creates index for column `staff_id`
        $this->createIndex(
            'idx-meetings_staff-staff_id',
            '{{%meetings_staff}}',
            'staff_id'
        );

        // add foreign key for table `staff`
        $this->addForeignKey(
            'fk-meetings_staff-staff_id',
            '{{%meetings_staff}}',
            'staff_id',
            '{{%staff}}',
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
            'fk-meetings_staff-meetings_id',
            '{{%meetings_staff}}'
        );

        // drops index for column `meetings_id`
        $this->dropIndex(
            'idx-meetings_staff-meetings_id',
            '{{%meetings_staff}}'
        );

        // drops foreign key for table `staff`
        $this->dropForeignKey(
            'fk-meetings_staff-staff_id',
            '{{%meetings_staff}}'
        );

        // drops index for column `staff_id`
        $this->dropIndex(
            'idx-meetings_staff-staff_id',
            '{{%meetings_staff}}'
        );

        $this->dropTable('{{%meetings_staff}}');
    }
}
