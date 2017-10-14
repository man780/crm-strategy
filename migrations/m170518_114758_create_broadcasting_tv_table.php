<?php

use yii\db\Migration;

/**
 * Handles the creation of table `broadcasting_tv`.
 * Has foreign keys to the tables:
 *
 * - `event`
 * - `tv`
 */
class m170518_114758_create_broadcasting_tv_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%broadcasting_tv}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'tv_id' => $this->integer()->notNull(),
            'date' => $this->integer(),
            'title' => $this->string(),
            'body' => $this->text(),
        ]);

        // creates index for column `event_id`
        $this->createIndex(
            'idx-broadcasting_tv-event_id',
            '{{%broadcasting_tv}}',
            'event_id'
        );

        // add foreign key for table `event`
        $this->addForeignKey(
            'fk-broadcasting_tv-event_id',
            '{{%broadcasting_tv}}',
            'event_id',
            '{{%event}}',
            'id',
            'CASCADE'
        );

        // creates index for column `tv_id`
        $this->createIndex(
            'idx-broadcasting_tv-tv_id',
            '{{%broadcasting_tv}}',
            'tv_id'
        );

        // add foreign key for table `tv`
        $this->addForeignKey(
            'fk-broadcasting_tv-tv_id',
            '{{%broadcasting_tv}}',
            'tv_id',
            '{{%tv}}',
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
            'fk-broadcasting_tv-event_id',
            '{{%broadcasting_tv}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            'idx-broadcasting_tv-event_id',
            '{{%broadcasting_tv}}'
        );

        // drops foreign key for table `tv`
        $this->dropForeignKey(
            'fk-broadcasting_tv-tv_id',
            '{{%broadcasting_tv}}'
        );

        // drops index for column `tv_id`
        $this->dropIndex(
            'idx-broadcasting_tv-tv_id',
            '{{%broadcasting_tv}}'
        );

        $this->dropTable('{{%broadcasting_tv}}');
    }
}
