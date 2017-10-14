<?php

use yii\db\Migration;

/**
 * Handles the creation of table `financing`.
 * Has foreign keys to the tables:
 *
 * - `event`
 * - `source_financing`
 * - `currency`
 */
class m170517_121419_create_financing_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%financing}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'sf_id' => $this->integer()->notNull(),
            'amount' => $this->integer(),
            'currency' => $this->integer()->notNull(),
            'body' => $this->text(),
        ]);

        // creates index for column `event_id`
        $this->createIndex(
            'idx-financing-event_id',
            '{{%financing}}',
            'event_id'
        );

        // add foreign key for table `event`
        $this->addForeignKey(
            'fk-financing-event_id',
            '{{%financing}}',
            'event_id',
            '{{%event}}',
            'id',
            'CASCADE'
        );

        // creates index for column `sf_id`
        $this->createIndex(
            'idx-financing-sf_id',
            '{{%financing}}',
            'sf_id'
        );

        // add foreign key for table `source_financing`
        $this->addForeignKey(
            'fk-financing-sf_id',
            '{{%financing}}',
            'sf_id',
            '{{%source_financing}}',
            'id',
            'CASCADE'
        );

        // creates index for column `currency`
        $this->createIndex(
            'idx-financing-currency',
            '{{%financing}}',
            'currency'
        );

        // add foreign key for table `currency`
        $this->addForeignKey(
            'fk-financing-currency',
            '{{%financing}}',
            'currency',
            '{{%currency}}',
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
            'fk-financing-event_id',
            '{{%financing}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            'idx-financing-event_id',
            '{{%financing}}'
        );

        // drops foreign key for table `source_financing`
        $this->dropForeignKey(
            'fk-financing-sf_id',
            '{{%financing}}'
        );

        // drops index for column `sf_id`
        $this->dropIndex(
            'idx-financing-sf_id',
            '{{%financing}}'
        );

        // drops foreign key for table `currency`
        $this->dropForeignKey(
            'fk-financing-currency',
            '{{%financing}}'
        );

        // drops index for column `currency`
        $this->dropIndex(
            'idx-financing-currency',
            '{{%financing}}'
        );

        $this->dropTable('{{%financing}}');
    }
}
