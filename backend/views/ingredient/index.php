<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\IngredientSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ингредиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-index">

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
                    return Html::a( Html::img('../../uploads/ingredient/'.$model->fname, ['style' => 'width:100px']),
                        '../../uploads/ingredient/'.$model->fname, ['class'=>'fancyimage','rel'=>'gallery']); // ссылка для fancybox
                },
            ],

            'name',
            
            [
                'attribute' => 'visible',
                'format' => 'boolean',
                'filter' => Html::activeDropDownList($searchModel, 'visible',
                    [0 => 'Нет', 1 => 'Да'],
                    ['prompt' => 'Выберите...', 'class' => 'form-control', 'multiple' => false]),
            ],
            
            'created_at:datetime',
            'updated_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
