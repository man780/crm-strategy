<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sub_direction`.
 * Has foreign keys to the tables:
 *
 * - `direction`
 */
class m170512_153224_create_sub_direction_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%sub_direction}}', [
            'id' => $this->primaryKey(),
            'direction_id' => $this->integer()->notNull(),
            'title' => $this->string(),
            'body' => $this->text(),
        ]);

        // creates index for column `direction_id`
        $this->createIndex(
            'idx-sub_direction-direction_id',
            '{{%sub_direction}}',
            'direction_id'
        );

        // add foreign key for table `direction`
        $this->addForeignKey(
            'fk-sub_direction-direction_id',
            '{{%sub_direction}}',
            'direction_id',
            '{{%direction}}',
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
            'fk-sub_direction-direction_id',
            '{{%sub_direction}}'
        );

        // drops index for column `direction_id`
        $this->dropIndex(
            'idx-sub_direction-direction_id',
            '{{%sub_direction}}'
        );

        $this->dropTable('{{%sub_direction}}');
    }
}
