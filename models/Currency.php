<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_currency".
 *
 * @property integer $id
 * @property string $name
 * @property string $details
 *
 * @property Financing[] $financings
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_currency';
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
    public function getFinancings()
    {
        return $this->hasMany(Financing::className(), ['currency' => 'id']);
    }
}
