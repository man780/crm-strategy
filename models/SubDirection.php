<?php

namespace app\models;

use app\models\Direction;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "st_sub_direction".
 *
 * @property integer $id
 * @property integer $direction_id
 * @property string $title
 * @property string $body
 * @property integer $num
 *
 * @property Event[] $events
 * @property Direction $direction
 */
class SubDirection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_sub_direction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['direction_id'], 'required'],
            [['direction_id', 'num'], 'integer'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['direction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direction::className(), 'targetAttribute' => ['direction_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'direction_id' => Yii::t('app', 'Direction ID'),
            'title' => Yii::t('app', 'Title'),
            'body' => Yii::t('app', 'Body'),
            'num' => Yii::t('app', 'Num'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['sub_dir_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirection()
    {
        return $this->hasOne(Direction::className(), ['id' => 'direction_id']);
    }

    public static function direction($direction){
        if($direction){
            $sub_dir = SubDirection::findAll(['direction_id' => $direction->id]);
            return ArrayHelper::map($sub_dir, 'id', 'title');
        }else{
            $sub_dir = SubDirection::find()->all();
            return ArrayHelper::map($sub_dir, 'id', 'title');
        }
    }
}
