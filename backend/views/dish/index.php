<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DishSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Блюда';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dish-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Фото',
                'format' => 'html',
                'filter' => false,
                'value' => function($model){
                    return Html::a( Html::img('../../uploads/dish/'.$model->fname, ['style' => 'width:100px']),
                        '../../uploads/dish/'.$model->fname, ['class'=>'fancyimage','rel'=>'gallery']); // ссылка для fancybox
                },
            ],

            'name',

            [
                'label' => 'Ингредиенты',
                'attribute'=>'ingredient',
                'format' => 'ntext',
                'value' => function($model) {
                    $groupNames = array();
                    foreach ($model->ingredients as $ingredient) {
                        $groupNames[] = $ingredient->name;
                    }
                    return implode(PHP_EOL, $groupNames);
                },
            ],

            [
                'attribute' => 'description',
                'value' => function ($model) {
                    return StringHelper::truncate($model->description, 64);
                }
            ],
            
            [
                'attribute' => 'visible',
                'format' => 'boolean',
                'filter' => Html::activeDropDownList($searchModel, 'visible',
                    [0 => 'Нет', 1 => 'Да'],
                    ['prompt' => 'Выберите...', 'class' => 'form-control', 'multiple' => false]),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
