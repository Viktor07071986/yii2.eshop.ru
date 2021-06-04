<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div class="product-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'category_id',
                'value' => function($data) {
                    return Html::a($data->category->name, Url::to('/category/' . $data->category->id), ['target' => '_blank']);
                },
                'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]]
            ],
            [
                'attribute' => 'name',
                'value' => function($data) {
                    return Html::a($data->name, Url::to('/product/' . $data->id), ['target' => '_blank']);
                },
                'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]]
            ],
            'price',
            [
                'attribute' => 'hit',
                'value' => function($data) {
                    return !$data->hit ? '<span class="text-danger">Нет</span>' : '<span class="text-success">Да</span>';
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'new',
                'value' => function($data) {
                    return !$data->new ? '<span class="text-danger">Нет</span>' : '<span class="text-success">Да</span>';
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'sale',
                'value' => function($data) {
                    return !$data->sale ? '<span class="text-danger">Нет</span>' : '<span class="text-success">Да</span>';
                },
                'format' => 'html',
            ],
            ['class' => 'yii\grid\ActionColumn']
        ]
    ]); ?>
</div>