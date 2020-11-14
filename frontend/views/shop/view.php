<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Simpleproducts */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Simpleproducts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simpleproducts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_simpleproduct], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_simpleproduct], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_simpleproduct',
            'name',
            'price',
            'description:ntext',
            'img',
        ],
    ]) ?>

</div>
