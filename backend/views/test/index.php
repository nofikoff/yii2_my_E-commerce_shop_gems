<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModelsStatusJournal_Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Test';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-status-journal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <pre>В окно для тестирования парсинга закидываем строки с описанием камней из 1С</pre>
    <pre>
Сапфір White круг 1,0 - 1,10, кар. алмаз
Сапфір White круг 1,2 - 1,3 , 2 пор., кар. алмаз
Шпінель синт. Swarovski круг 1,0 Blue Dark, шт
    </pre>

    <form method="post">
        <textarea rows="10" name="words" cols="80" class="form-control"></textarea>
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
        <br>
        <!--	<input type="checkbox" name="newchannels" value="1"  checked >-->
        <!---->
        <!--	При импорте, из имени каждого адреса - <b>создать самостоятельный Канал (если нет такого по названию)</b>  -получим один канал - один адрес.-->
        <!--	<br>Иначе все новые адреса (по названию которых еще НЕТ каналов) будут прикреплены к служебному каналу TEST<br>-->



        <pre>
        </pre>

        <br>

        <button type="submit" class="btn btn-success">Загрузить и просмотреть</button>
        <button type="submit" name='excel'class="btn btn-success">Загрузить и скачать Excel</button>

    </form>
</div>
