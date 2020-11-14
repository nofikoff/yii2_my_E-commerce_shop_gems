<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use frontend\models\SubscribeForm;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


AppAsset::register($this);

echo $this->render('/layouts/header', [
    //'model' => $model,
]);
?>


<div id="conteiner">

    <div class="breadcrumbs clearfix">
        <div style="display:flex;flex-wrap: wrap;justify-content: space-between;">
        <div class="prebread">
        <?= Breadcrumbs::widget([
            'homeLink' => ['label' => Yii::t('app', 'Драгоценные камни'), 'url' => '/shop'],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        </div>
            <?php
                echo "<div class='myfb02'>".$this->render('/news/_top_facebook_likebox')."</div>";
            ?>
        </div>

    </div>

    <?= Alert::widget() ?>

    <!--start content-->

    <?= $content ?>

    <!--end content-->
</div>
<!--НЕ ТРОГАЙ СЕКШН-->
</section>



<?= $this->render('/layouts/footer', [
    //'model' => $model,
]) ?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
    $(document).ready(function () {
        //Examples of how to assign the Colorbox event to elements
        $(".group1").colorbox({rel: 'group1'});
    });
</script>