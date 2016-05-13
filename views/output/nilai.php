<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Nilai */
/* @var $form yii\widgets\ActiveForm */
?>

<h1>Nilai</h1>

<div class="nilai-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jenjang')->dropDownList(
        [
            'D3'=>'D3','S1'=>'S1','S2'=>'S2','S3'=>'S3'
        ],[
        'prompt'=>'-Choose a jenjang-',
    ]);
    ?>

    <?= $form->field($model, 'fakultas')->dropDownList([],[
        'prompt'=>'-Choose a fakultas-',
    ]);
    ?>

    <?= $form->field($model, 'jurusan')->dropDownList([],[
        'prompt'=>'-Choose a jurusan-',
    ]);
    ?>

    <?= $form->field($model, 'tahun')->dropDownList([],[
        'prompt'=>'-Choose a tahun-',
    ]);
    ?>

    <?= $form->field($model, 'mahasiswa')->dropDownList([],[
        'prompt'=>'-Choose a mahasiswa-',
    ]);
    ?>

    <?php ActiveForm::end(); ?>

</div>

<div class="index">
<?php
Pjax::begin(['timeout'=>false,'id'=>'pjax-nilai']);

Pjax::end();
?>
<?php
$this->registerJs('
    $("#dynamicmodel-fakultas").attr("disabled",true);
    $("#dynamicmodel-jenjang").change(function() {
        $.get("'.Url::to(['get-fakultas','jenjang'=>'']).'" + $(this).val(), function(data) {
            select = $("#dynamicmodel-fakultas")
            select.empty();
            var options = "<option>-Choose a fakultas-</option>";
            $.each(data.fakultas, function(key, value) {
                options += "<option value=\'"+value.id+"\'>"+ value.name +"</option>";
            });
            select.append(options);
            $("#dynamicmodel-fakultas").attr("disabled",false);
        });
    });

    $("#dynamicmodel-jurusan").attr("disabled",true);
    $("#dynamicmodel-fakultas").change(function() {
        $.get("'.Url::to(['get-jurusan','fakultas'=>'']).'" + $(this).val(), function(data) {
            select = $("#dynamicmodel-jurusan")
            select.empty();
            var options = "<option>-Choose a jurusan-</option>";
            $.each(data.jurusan, function(key, value) {
                options += "<option value=\'"+value.id+"\'>"+ value.name +"</option>";
            });
            select.append(options);
            $("#dynamicmodel-jurusan").attr("disabled",false);
        });
    });

    $("#dynamicmodel-tahun").attr("disabled",true);
    var jurusan = 0;
    $("#dynamicmodel-jurusan").change(function() {
        jurusan = $(this).val();
        $.get("'.Url::to(['get-tahun','jurusan'=>'']).'" + $(this).val(), function(data) {
            select = $("#dynamicmodel-tahun")
            select.empty();
            var options = "<option>-Choose a tahun-</option>";
            $.each(data.mahasiswa, function(key, value) {
                options += "<option value=\'"+value.tahun+"\'>"+ value.tahun +"</option>";
            });
            select.append(options);
            $("#dynamicmodel-tahun").attr("disabled",false);
        });
    });

    $("#dynamicmodel-mahasiswa").attr("disabled",true);
    $("#dynamicmodel-tahun").change(function() {
        $.get("'.Url::to(['get-mahasiswa','tahun'=>'']).'" + $(this).val() + "&jurusan="+ jurusan, function(data) {
            select = $("#dynamicmodel-mahasiswa")
            select.empty();
            var options = "<option>-Choose a mahasiswa-</option>";
            $.each(data.mahasiswa, function(key, value) {
                options += "<option value=\'"+value.id+"\'>"+ value.name +"</option>";
            });
            select.append(options);
            $("#dynamicmodel-mahasiswa").attr("disabled",false);
        });
    });

    $("#dynamicmodel-mahasiswa").change(function() {
        if($(this).val()>0){
            $.pjax.reload("#pjax-nilai",{
                "timeout": false,
                "url": "'.Url::to(['get-nilai','mahasiswa_id'=>'']).'" + $(this).val() ,
                "replace": false,
            });
        }
    });
');
