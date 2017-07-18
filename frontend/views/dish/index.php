<?php
/**
 * Created by PhpStorm.
 * User: vaio_b970
 * Date: 01.07.2017
 * Time: 19:14
 */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\FilterDishForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//foreach ($model as $author) {
//  echo "<h2>Author : " . $author->name . "</h2>";
//  echo "<ul>";
//  foreach ($author->ingredients as $post) {  // no query executed here
//      echo "<li>" . $post->name . "</li>";
//  }
//  echo "</ul>";
//}

$this->title = 'Блюда';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dish-index">
<?php print_r($dish);?>
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Фильтры</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <?php $form = ActiveForm::begin(['id' => 'form-filter_dish',
                                'enableClientValidation' => false,
                                'enableAjaxValidation' => true,
                                'action' => ['/dish/index'],
                                'validationUrl' => ['/dish/perform-ajax-validation-dish'],
                            ]); ?>
                            <?= $form->errorSummary($model) ?>
                            <div class="col-lg-12">
                                <?= $form->field($model, 'ingredient_1st')->dropDownList(
                                    \common\models\Ingredient::GetFilter(),
                                    ['id' => 'dish-ingredient_1st',
                                        'prompt' => 'Выберите ингредиент...']) ?>

                                <?= $form->field($model, 'ingredient_2nd')->dropDownList(
                                    \common\models\Ingredient::GetFilter(),
                                    ['id' => 'dish-ingredient_2nd',
                                        'prompt' => 'Выберите ингредиент...']) ?>

                                <?= $form->field($model, 'ingredient_3rd')->dropDownList(
                                    \common\models\Ingredient::GetFilter(),
                                    ['id' => 'dish-ingredient_3rd',
                                        'prompt' => 'Выберите ингредиент...']) ?>

                                <?= $form->field($model, 'ingredient_4th')->dropDownList(
                                    \common\models\Ingredient::GetFilter(),
                                    ['id' => 'dish-ingredient_4th',
                                        'prompt' => 'Выберите ингредиент...']) ?>

                                <?= $form->field($model, 'ingredient_5th')->dropDownList(
                                    \common\models\Ingredient::GetFilter(),
                                    ['id' => 'dish-ingredient_5th',
                                        'prompt' => 'Выберите ингредиент...']) ?>

                                <div class="form-group">
                                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">

            </div>
        </div>

    </div>
</div>
