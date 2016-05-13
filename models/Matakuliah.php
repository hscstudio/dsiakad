<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "matakuliah".
 *
 * @property integer $id
 * @property string $kode
 * @property string $name
 * @property integer $sks
 *
 * @property Studi[] $studis
 */
class Matakuliah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matakuliah';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode', 'name', 'sks'], 'required'],
            [['sks'], 'integer'],
            [['kode'], 'string', 'max' => 15],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'name' => 'Name',
            'sks' => 'Sks',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudis()
    {
        return $this->hasMany(Studi::className(), ['matakuliah_id' => 'id']);
    }
}
