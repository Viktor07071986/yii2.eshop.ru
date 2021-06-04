<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

?>

<div class="product-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данный товар?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php $img = $model->getImage(); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => Html::a($model->category->name, Url::to('/category/' . $model->category->id), ['target' => '_blank']),
                'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]]
            ],
            [
                'attribute' => 'name',
                'value' => Html::a($model->name, Url::to('/product/' . $model->id), ['target' => '_blank']),
                'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]]
            ],
            'content:html',
            'price',
            'keywords',
            'description',
            [
                'attribute' => 'image',
                'value' => "<img src='{$img->getUrl()}'>",
                'format' => 'html',
            ],
            [
                'attribute' => 'hit',
                'value' => !$model->hit ? '<span class="text-danger">Нет</span>' : '<span class="text-success">Да</span>',
                'format' => 'html',
            ],
            [
                'attribute' => 'new',
                'value' => !$model->new ? '<span class="text-danger">Нет</span>' : '<span class="text-success">Да</span>',
                'format' => 'html',
            ],
            [
                'attribute' => 'sale',
                'value' =>  !$model->sale ? '<span class="text-danger">Нет</span>' : '<span class="text-success">Да</span>',
                'format' => 'html',
            ],

        ],
    ]) ?>
</div>