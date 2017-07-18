<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Ingredient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingredient-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-lg-5">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

    </div>

    <div class="row">
        
        <div class="col-lg-5">
            <!-- Changed if has image -->
            <?php if ($model->fname): ?>
                <?= Html::label('Фото') ?>

                <?= Html::a(Html::img('../../uploads/ingredient/' . $model->fname, ['style' => 'width:50px']),
                    '../../uploads/ingredient/' . $model->fname, [
                        'class' => 'fancyimage', 'rel' => 'gallery']); ?>
            <?php endif; ?>

            <?= $form->field($model, 'load_picture')->fileInput(['id' => 'input_file', 'class' => 'file', 'type' => 'file']) ?>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-5">
            <?= $form->field($model, 'visible')->checkbox() ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
