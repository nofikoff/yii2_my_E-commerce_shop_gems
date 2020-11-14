<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['/pages']];


?>


<div class="news">
       
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $models,
            'itemView'     => '_view', 
            'layout'     => '{items}{pager}',
      
        ]); ?>
       
     
            
</div>


