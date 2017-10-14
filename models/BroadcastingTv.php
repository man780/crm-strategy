<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_broadcasting_tv".
 *
 * @property integer $id
 * @property integer $execution_id
 * @property integer $event_id
 * @property integer $tv_id
 * @property integer $date
 * @property string $title
 * @property string $body
 *
 * @property Tv $tv
 * @property Event $event
 */
class BroadcastingTv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_broadcasting_tv';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'tv_id', 'execution_id'], 'required'],
            [['event_id', 'tv_id', 'date', 'execution_id'], 'integer'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['tv_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tv::className(), 'targetAttribute' => ['tv_id' => 'id']],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['execution_id'], 'exist', 'skipOnError' => true, 'targetClass' => Execution::className(), 'targetAttribute' => ['execution_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'execution_id' => Yii::t('app', 'Execution ID'),
            'event_id' => Yii::t('app', 'Event ID'),
            'tv_id' => Yii::t('app', 'Tv ID'),
            'date' => Yii::t('app', 'Date'),
            'title' => Yii::t('app', 'Title'),
            'body' => Yii::t('app', 'Body'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTv()
    {
        return $this->hasOne(Tv::className(), ['id' => 'tv_id']);
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
}
