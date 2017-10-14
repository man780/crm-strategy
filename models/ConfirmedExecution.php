<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_confirmed_execution".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $execution_id
 * @property integer $event_id
 * @property integer $dcreated
 * @property string $note
 * @property string $new_execution_information
 *
 * @property Event $event
 * @property Execution $execution
 * @property User $user
 */
class ConfirmedExecution extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_confirmed_execution';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'execution_id', 'event_id', 'dcreated'], 'integer'],
            [['note', 'new_execution_information'], 'string'],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['execution_id'], 'exist', 'skipOnError' => true, 'targetClass' => Execution::className(), 'targetAttribute' => ['execution_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'execution_id' => Yii::t('app', 'Execution ID'),
            'event_id' => Yii::t('app', 'Event ID'),
            'dcreated' => Yii::t('app', 'Dcreated'),
            'note' => Yii::t('app', 'Note'),
            'new_execution_information' => Yii::t('app', 'New Execution Information'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecution()
    {
        return $this->hasOne(Execution::className(), ['id' => 'execution_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
