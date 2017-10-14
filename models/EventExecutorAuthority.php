<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_event_executor_authority".
 *
 * @property integer $event_id
 * @property integer $executor_authority_id
 * @property integer $sequence_exec
 * @property integer $created_at
 *
 * @property ExecutorAuthority $executorAuthority
 * @property Event $event
 */
class EventExecutorAuthority extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_event_executor_authority';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'executor_authority_id', 'sequence_exec', 'created_at'], 'integer'],
            [['executor_authority_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExecutorAuthority::className(), 'targetAttribute' => ['executor_authority_id' => 'id']],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'event_id' => Yii::t('app', 'Event ID'),
            'executor_authority_id' => Yii::t('app', 'Executor Authority ID'),
            'sequence_exec' => Yii::t('app', 'Sequence Exec'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutorAuthority()
    {
        return $this->hasOne(ExecutorAuthority::className(), ['id' => 'executor_authority_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    public function getAuthoritiesByEventId($id)
    {
        return self::find()->where(['event_id' => $id])->orderBy('sequence_exec')->all();
    }
}
