<?php

use yii\db\Migration;

/**
 * Handles the creation of table `broadcasting_internet`.
 * Has foreign keys to the tables:
 *
 * - `event`
 * - `internet`
 */
class m170518_115652_create_broadcasting_internet_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%broadcasting_internet}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'internet_id' => $this->integer()->notNull(),
            'date' => $this->integer(),
            'title' => $this->string(),
            'details' => $this->text(),
        ]);

        // creates index for column `event_id`
        $this->createIndex(
            'idx-broadcasting_internet-event_id',
            '{{%broadcasting_internet}}',
            'event_id'
        );

        // add foreign key for table `event`
        $this->addForeignKey(
            'fk-broadcasting_internet-event_id',
            '{{%broadcasting_internet}}',
            'event_id',
            '{{%event}}',
            'id',
            'CASCADE'
        );

        // creates index for column `internet_id`
        $this->createIndex(
            'idx-broadcasting_internet-internet_id',
            '{{%broadcasting_internet}}',
            'internet_id'
        );

        // add foreign key for table `internet`
        $this->addForeignKey(
            'fk-broadcasting_internet-internet_id',
            '{{%broadcasting_internet}}',
            'internet_id',
            '{{%internet}}',
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
            'fk-broadcasting_internet-event_id',
            '{{%broadcasting_internet}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            'idx-broadcasting_internet-event_id',
            '{{%broadcasting_internet}}'
        );

        // drops foreign key for table `internet`
        $this->dropForeignKey(
            'fk-broadcasting_internet-internet_id',
            '{{%broadcasting_internet}}'
        );

        // drops index for column `internet_id`
        $this->dropIndex(
            'idx-broadcasting_internet-internet_id',
            '{{%broadcasting_internet}}'
        );

        $this->dropTable('{{%broadcasting_internet}}');
    }
}
