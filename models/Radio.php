<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_radio".
 *
 * @property integer $id
 * @property string $name
 * @property string $details
 *
 * @property BroadcastingRadio[] $broadcastingRadios
 */
class Radio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_radio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['details'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'details' => Yii::t('app', 'Details'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcastingRadios()
    {
        return $this->hasMany(BroadcastingRadio::className(), ['radio_id' => 'id']);
    }
}
