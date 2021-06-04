<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */

?>

<div class="category-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if ($count_parent_category == 0 && $count_parent_product == 0) { ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данную категорию?',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'parent_id',
                'value' => $model->category->name ? $model->category->name : 'Самостоятельная категория'
            ],
            [
                'attribute' => 'name',
                'value' => Html::a($model->name, Url::to('/category/' . $model->id), ['target' => '_blank']),
                'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]]
            ],
            'keywords',
            'description',
        ],
    ]) ?>
</div>