<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mahasiswa".
 *
 * @property integer $id
 * @property string $nim
 * @property string $name
 * @property integer $jurusan_id
 * @property string $tahun
 *
 * @property Jurusan $jurusan
 * @property Nilai[] $nilais
 * @property Studi[] $studis
 */
class Mahasiswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mahasiswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nim', 'name', 'jurusan_id', 'tahun'], 'required'],
            [['jurusan_id'], 'integer'],
            [['tahun'], 'safe'],
            [['nim'], 'string', 'max' => 15],
            [['name'], 'string', 'max' => 255],
            [['nim'], 'unique'],
            [['jurusan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jurusan::className(), 'targetAttribute' => ['jurusan_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nim' => 'Nim',
            'name' => 'Name',
            'jurusan_id' => 'Jurusan ID',
            'tahun' => 'Tahun',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJurusan()
    {
        return $this->hasOne(Jurusan::className(), ['id' => 'jurusan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNilais()
    {
        return $this->hasMany(Nilai::className(), ['mahasiswa_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudis()
    {
        return $this->hasMany(Studi::className(), ['mahasiswa_id' => 'id']);
    }
}
