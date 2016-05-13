<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Nilai */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nilai-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $data = \app\models\Mahasiswa::find()->all();
    $data = ArrayHelper::map($data, 'id', 'name');
    echo $form->field($model, 'mahasiswa_id')->dropDownList($data,[
        'prompt'=>'-Choose a mahasiswa-',
    ]);
    ?>

    <?= $form->field($model, 'ijazah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skripsi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sks')->textInput() ?>

    <?= $form->field($model, 'nilai')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
