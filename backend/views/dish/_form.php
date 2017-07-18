<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Dish */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dish-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <div class="col-lg-5">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-5">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-5">
            <!-- Changed if has image -->
            <?php if ($model->fname): ?>
                <?= Html::label('Фото') ?>

                <?= Html::a(Html::img('../../uploads/dish/' . $model->fname, ['style' => 'width:50px']),
                    '../../uploads/dish/' . $model->fname, [
                        'class' => 'fancyimage', 'rel' => 'gallery']); ?>
            <?php endif; ?>

            <?= $form->field($model, 'load_picture')->fileInput(['id' => 'input_file', 'class' => 'file', 'type' => 'file']) ?>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-5">
            <?= $form->field($model, 'visible')->checkbox() ?>
        </div>

        <fieldset>
            <legend>Ингредиенты</legend>
            <?= $form->field($model, 'id_ingredient')->widget(\kartik\select2\Select2::className(), [
                'model' => $model,
                'attribute' => 'id_ingredient',
                'data' => \yii\helpers\ArrayHelper::map(\common\models\Ingredient::find()->all(), 'name', 'name'),
                'options' => [
                    'multiple' => true,
                ],
                'pluginOptions' => [
                    'ingredients' => true,
                ],
            ]); ?>
        </fieldset>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
