<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
?>
<div class="replyBlock">
  <span class="date_otz" style="display: none;">DD.MM.YYYY</span>
  <div class="headReply"><h5><?= Yii::t('app', 'Автор') ?>: <?= $model->author_review ?>:</h5></div>
  <?= $model->text_review ?>
</div>
