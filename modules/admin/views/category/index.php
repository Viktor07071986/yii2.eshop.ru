<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div class="category-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'parent_id',
                'value' => function($data) {
                    return $data->category->name ? $data->category->name : 'Самостоятельная категория';
                }
            ],
            [
                'attribute' => 'name',
                'value' => function($data) {
                    return Html::a($data->name, Url::to('/category/' . $data->id), ['target' => '_blank']);
                },
                'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]]
            ],
            'keywords',
            'description',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],
    ]); ?>
</div>