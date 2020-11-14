<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Бренды камней из 1с - вебсайт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="container">
        <div class="row">
            <div class="col-sm-9 myrow">
                <h2>Драгоценные</h2>
            </div>
            <div class="col-sm-3 myrow">
                <h2>Синтетика</h2>

            </div>
        </div>


        <div class="row">
            <div class="col-sm-4 myrow">
                <h3>Натуральные</h3>

            </div>
            <div class="col-sm-5 myrow">
                <h3>Искусствен.</h3>
            </div>
            <div class="col-sm-3 myrow">
                <h3>Искусствен.</h3>
            </div>

        </div>


        <div class="row">
            <div class="col-sm-2 myrow">
                <a href="/admin/options/update?id=1">руч. (модельные)<br>drag_natural_handmademodelnye</a>
            </div>
            <div class="col-sm-2 myrow">
                <a href="/admin/options/update?id=2">маш. (signiti)<br>drag_natural_machineautokolibred_signiti</a>
            </div>
            <div class="col-sm-2 myrow">
                <a href="/admin/options/update?id=3">маш. (swarowski)<br>drag_artificial_machineautokolibred_swarowski</a>
            </div>
            <div class="col-sm-3 myrow">
                <a href="/admin/options/update?id=4">маш.<br>drag_artificial_machineautokolibred_other_sintetic</a>
            </div>
            <div class="col-sm-3 myrow">
                <a href="/admin/options/update?id=5">маш.<br>nedrag_artificial_machineautokolibred_swarowski_kuboxidcirkon</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 ">
               <pre><?=  Yii::$app->get('settings')->get('brands.drag_natural_handmademodelnye')?></pre>
            </div>
            <div class="col-sm-2 ">
                <pre><?=  Yii::$app->get('settings')->get('brands.drag_natural_machineautokolibred_signiti')?></pre>

            </div>
            <div class="col-sm-2 ">
                <pre><?=  Yii::$app->get('settings')->get('brands.drag_artificial_machineautokolibred_swarowski')?></pre>

            </div>
            <div class="col-sm-3 ">

                <pre><?=  Yii::$app->get('settings')->get('brands.drag_artificial_machineautokolibred_other_sintetic')?></pre>

            </div>
            <div class="col-sm-3 ">
                <pre><?=  Yii::$app->get('settings')->get('brands.nedrag_artificial_machineautokolibred_swarowski_kuboxidcirkon')?></pre>

            </div>
        </div>
    </div>

</div>
