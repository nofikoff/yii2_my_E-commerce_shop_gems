<?php

use yii\helpers\Html;

/** ЭТО СПИСОК СЛУЖЕБНЫХ СТРАНИЦ - ЕГО НАФИГ НЕ НАДО ИНДЕКСИРОВАТЬ !!  */


?>


<?= Html::a($model->{'name'.(Yii::$app->language == 'uk' ? '_ua' : '')}, ['/pages/'.$model->url]) ?>
<?= $model->{'anons'.(Yii::$app->language == 'uk' ? '_ua' : '')} ?>
<div>
    <?= Html::a(Yii::t('app','Подробнее'), ['/pages/'.$model->url]) ?>
</div>
<br/><br/>
