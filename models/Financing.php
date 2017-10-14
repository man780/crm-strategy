<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_financing".
 *
 * @property integer $id
 * @property integer $event_id
 * @property integer $sf_id
 * @property integer $amount
 * @property integer $currency
 * @property string $body
 *
 * @property Currency $currency0
 * @property Event $event
 * @property SourceFinancing $sf
 */
class Financing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_financing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'sf_id', 'currency'], 'required'],
            [['event_id', 'sf_id', 'amount', 'currency'], 'integer'],
            [['body'], 'string'],
            [['currency'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency' => 'id']],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['sf_id'], 'exist', 'skipOnError' => true, 'targetClass' => SourceFinancing::className(), 'targetAttribute' => ['sf_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'event_id' => Yii::t('app', 'Event ID'),
            'sf_id' => Yii::t('app', 'Sf ID'),
            'amount' => Yii::t('app', 'Amount'),
            'currency' => Yii::t('app', 'Currency'),
            'body' => Yii::t('app', 'Body'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency0()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency']);
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
    public function getSf()
    {
        return $this->hasOne(SourceFinancing::className(), ['id' => 'sf_id']);
    }
}
