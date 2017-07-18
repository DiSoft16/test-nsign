<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Dish */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Блюда', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dish-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

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

            'description:ntext',

            [
                'label' => 'Фото',
                'attribute' => 'fname',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a(Html::img('/uploads/dish/' . $model->fname, ['style' => 'width:200px']),
                        '/uploads/dish/' . $model->fname, ['class' => 'fancyimage', 'rel' => 'gallery']);
                }
            ],
            
            'visible:boolean',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
