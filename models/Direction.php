<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "st_direction".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $color
 *
 * @property Event[] $events
 * @property SubDirection[] $subDirections
 */
class Direction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_direction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'image'], 'string', 'max' => 255],
            [['color'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'image' => Yii::t('app', 'Image'),
            'color' => Yii::t('app', 'Color'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['direction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubDirections()
    {
        return $this->hasMany(SubDirection::className(), ['direction_id' => 'id']);
    }

    public function getDirectionsMap(){
        return ArrayHelper::map(self::find()->asArray()->all(), 'id', 'title');
    }
}
