<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'История заказов');
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'История заказов'), ['/shop/user'], ['class' => 'btn btn-success']) ?> |
        <?= Html::a(Yii::t('app', 'Изменить пароль'), ['/site/request-password-reset'], ['class' => 'btn btn-success']) ?>
        |
        <?= Html::a(Yii::t('app', 'Смена контактных данных'), ['user/edit'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>&nbsp;</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'name_orders',

            [
                'attribute' => 'id_orders',
                'label' => Yii::t('app', 'ID заказа'),
            ],
            [
                'label' => Yii::t('app', 'Товар'),
                'format' => 'raw',
                'value' => function ($model) {
                    $a = '';
                    foreach ($model->ordersProducts as $p) {
                        if (\common\models\ProductGemsPrices::find()
                            ->where(['id_product' => $p->id_product])
                            ->exists()
                        ) {
                            $a .= '<a href="/shop/gems?id=' . $p->id_product . '">' . $p->name_orders_products . "</a> " . $p->quantity . "шт. - " . $p->summ . " Грн.<br>";
                        } else {
                            $a .= '' . $p->name_orders_products . " " . $p->quantity . "шт. - " . $p->summ . " Грн.<br>";

                        }
                    }
                    return $a;
                },
            ],

            [
                'label' => Yii::t('app', 'Дата'),
                'format' => 'raw',
                'value' => function ($model) {
                    return date("Y-m-d H:s", $model->date_added);
                },
            ],
        ],
    ]); ?>
</div>
