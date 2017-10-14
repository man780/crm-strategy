<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_press".
 *
 * @property integer $id
 * @property string $name
 * @property string $details
 *
 * @property BroadcastingPress[] $broadcastingPresses
 */
class Press extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_press';
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
    public function getBroadcastingPresses()
    {
        return $this->hasMany(BroadcastingPress::className(), ['press_id' => 'id']);
    }
}
