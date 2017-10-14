<?php

use yii\db\Migration;

/**
 * Handles the creation of table `broadcasting_press`.
 * Has foreign keys to the tables:
 *
 * - `event`
 * - `press`
 */
class m170518_114958_create_broadcasting_press_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%broadcasting_press}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'press_id' => $this->integer()->notNull(),
            'date' => $this->integer(),
            'title' => $this->string(),
            'details' => $this->text(),
        ]);

        // creates index for column `event_id`
        $this->createIndex(
            'idx-broadcasting_press-event_id',
            '{{%broadcasting_press}}',
            'event_id'
        );

        // add foreign key for table `event`
        $this->addForeignKey(
            'fk-broadcasting_press-event_id',
            '{{%broadcasting_press}}',
            'event_id',
            '{{%event}}',
            'id',
            'CASCADE'
        );

        // creates index for column `press_id`
        $this->createIndex(
            'idx-broadcasting_press-press_id',
            '{{%broadcasting_press}}',
            'press_id'
        );

        // add foreign key for table `press`
        $this->addForeignKey(
            'fk-broadcasting_press-press_id',
            '{{%broadcasting_press}}',
            'press_id',
            '{{%press}}',
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
            'fk-broadcasting_press-event_id',
            '{{%broadcasting_press}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            'idx-broadcasting_press-event_id',
            '{{%broadcasting_press}}'
        );

        // drops foreign key for table `press`
        $this->dropForeignKey(
            'fk-broadcasting_press-press_id',
            '{{%broadcasting_press}}'
        );

        // drops index for column `press_id`
        $this->dropIndex(
            'idx-broadcasting_press-press_id',
            '{{%broadcasting_press}}'
        );

        $this->dropTable('{{%broadcasting_press}}');
    }
}
