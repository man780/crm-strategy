<?php

use yii\db\Migration;

/**
 * Handles adding execution_id to table `broadcasting_internet`.
 * Has foreign keys to the tables:
 *
 * - `execution`
 */
class m170530_120802_add_execution_id_column_to_broadcasting_internet_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%broadcasting_internet}}', 'execution_id', $this->integer()->notNull());

        // creates index for column `execution_id`
        $this->createIndex(
            'idx-broadcasting_internet-execution_id',
            '{{%broadcasting_internet}}',
            'execution_id'
        );

        // add foreign key for table `execution`
        $this->addForeignKey(
            'fk-broadcasting_internet-execution_id',
            '{{%broadcasting_internet}}',
            'execution_id',
            '{{%execution}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `execution`
        $this->dropForeignKey(
            'fk-broadcasting_internet-execution_id',
            '{{%broadcasting_internet}}'
        );

        // drops index for column `execution_id`
        $this->dropIndex(
            'idx-broadcasting_internet-execution_id',
            '{{%broadcasting_internet}}'
        );

        $this->dropColumn('{{%broadcasting_internet}}', 'execution_id');
    }
}
