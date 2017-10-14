<?php

use yii\db\Migration;

/**
 * Handles the creation of table `broadcasting_radio`.
 * Has foreign keys to the tables:
 *
 * - `event`
 * - `radio`
 */
class m170518_114911_create_broadcasting_radio_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%broadcasting_radio}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'radio_id' => $this->integer()->notNull(),
            'date' => $this->integer(),
            'title' => $this->string(),
            'details' => $this->text(),
        ]);

        // creates index for column `event_id`
        $this->createIndex(
            'idx-broadcasting_radio-event_id',
            '{{%broadcasting_radio}}',
            'event_id'
        );

        // add foreign key for table `event`
        $this->addForeignKey(
            'fk-broadcasting_radio-event_id',
            '{{%broadcasting_radio}}',
            'event_id',
            '{{%event}}',
            'id',
            'CASCADE'
        );

        // creates index for column `radio_id`
        $this->createIndex(
            'idx-broadcasting_radio-radio_id',
            '{{%broadcasting_radio}}',
            'radio_id'
        );

        // add foreign key for table `radio`
        $this->addForeignKey(
            'fk-broadcasting_radio-radio_id',
            '{{%broadcasting_radio}}',
            'radio_id',
            '{{%radio}}',
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
            'fk-broadcasting_radio-event_id',
            '{{%broadcasting_radio}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            'idx-broadcasting_radio-event_id',
            '{{%broadcasting_radio}}'
        );

        // drops foreign key for table `radio`
        $this->dropForeignKey(
            'fk-broadcasting_radio-radio_id',
            '{{%broadcasting_radio}}'
        );

        // drops index for column `radio_id`
        $this->dropIndex(
            'idx-broadcasting_radio-radio_id',
            '{{%broadcasting_radio}}'
        );

        $this->dropTable('{{%broadcasting_radio}}');
    }
}
