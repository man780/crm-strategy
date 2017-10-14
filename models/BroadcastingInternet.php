<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_broadcasting_internet".
 *
 * @property integer $id
 * @property integer $execution_id
 * @property integer $event_id
 * @property integer $internet_id
 * @property integer $date
 * @property integer $link
 * @property string $title
 * @property string $details
 *
 * @property Internet $internet
 * @property Event $event
 */
class BroadcastingInternet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_broadcasting_internet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'internet_id', 'execution_id'], 'required'],
            [['event_id', 'internet_id', 'date'], 'integer'],
            [['details'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['internet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Internet::className(), 'targetAttribute' => ['internet_id' => 'id']],
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
            'internet_id' => Yii::t('app', 'Internet ID'),
            'date' => Yii::t('app', 'Date'),
            'link' => Yii::t('app', 'Link'),
            'title' => Yii::t('app', 'Title'),
            'details' => Yii::t('app', 'Details'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternet()
    {
        return $this->hasOne(Internet::className(), ['id' => 'internet_id']);
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
