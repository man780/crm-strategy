<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_tv".
 *
 * @property integer $id
 * @property string $name
 * @property string $details
 *
 * @property BroadcastingTv[] $broadcastingTvs
 */
class Tv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_tv';
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
    public function getBroadcastingTvs()
    {
        return $this->hasMany(BroadcastingTv::className(), ['tv_id' => 'id']);
    }
}
