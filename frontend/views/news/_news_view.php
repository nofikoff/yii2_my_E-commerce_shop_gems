<?php

use yii\helpers\Html;

?>
<?= Html::a($model->{'name'.(Yii::$app->language == 'uk' ? '_ua' : '')}, ['/news/'.$model->url]) ?>
<?= $model->{'anons'.(Yii::$app->language == 'uk' ? '_ua' : '')} ?>
<div>
<?= Html::a(Yii::t('app','Подробнее'), ['/news/'.$model->url]) ?>
</div>
<br/><br/>
