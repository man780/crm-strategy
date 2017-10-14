<?php

use yii\db\Migration;

/**
 * Handles the creation of table `meeting_guests`.
 */
class m171009_053846_create_meeting_guests_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%meeting_guests}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'position' => $this->string(),
            'organization' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%meeting_guests}}');
    }
}
