<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "studi".
 *
 * @property integer $id
 * @property integer $mahasiswa_id
 * @property integer $matakuliah_id
 * @property string $nilai
 *
 * @property Mahasiswa $mahasiswa
 * @property Matakuliah $matakuliah
 */
class Studi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'studi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mahasiswa_id', 'matakuliah_id', 'nilai'], 'required'],
            [['mahasiswa_id', 'matakuliah_id'], 'integer'],
            [['nilai'], 'number'],
            [['mahasiswa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mahasiswa::className(), 'targetAttribute' => ['mahasiswa_id' => 'id']],
            [['matakuliah_id'], 'exist', 'skipOnError' => true, 'targetClass' => Matakuliah::className(), 'targetAttribute' => ['matakuliah_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mahasiswa_id' => 'Mahasiswa ID',
            'matakuliah_id' => 'Matakuliah ID',
            'nilai' => 'Nilai',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMahasiswa()
    {
        return $this->hasOne(Mahasiswa::className(), ['id' => 'mahasiswa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatakuliah()
    {
        return $this->hasOne(Matakuliah::className(), ['id' => 'matakuliah_id']);
    }
}
