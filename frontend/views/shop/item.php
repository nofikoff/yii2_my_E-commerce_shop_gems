<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;


//$this->title = Yii::t('app', 'Каталог камней');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Натуральные драгоценные камни'), 'url' => ['/shop/']];
$this->params['breadcrumbs'][] = ['label' => '' . $model->typeProduct->name, 'url' => ['/shop?FilterForm%5Btype%5D=' . $model->typeProduct->id_product_type]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'цвет') . ' ' . $model->colorProduct->{'name_color' . (Yii::$app->language == 'uk' ? '_ua' : '')}, 'url' => ['/shop?FilterForm%5Bcolor%5D=' . $model->colorProduct->color_group_id]];
//$this->params['breadcrumbs'][] = $this->title;

$curr = Yii::$app->currency->getCurrency();


foreach ($this->params['breadcrumbs'] as $key => $a) {

    // первую херим и те что без адресов
    if (isset($a['label']) AND $key != 0) {
        $this->title .= ' | ' . $a['label'];
    } else if (!is_array($a)) {
        // что это было?
        $this->title .= ' | ' . $a;
    }
}

// получаем список камней в таблице с ценами
// почему здесь, нам нужен массив типов огранки ля камушка $shapes_id_array
$shape = '';
$shapes_id_array = [];
$echo_gems_table = '';
foreach ($items as $id => $item) : ?>
    <?php
// переберем все камушки, выберем массив типов огранки
    if (!in_array($item->shape0->id_shape, $shapes_id_array)) $shapes_id_array[] = $item->shape0->id_shape;

    if ($shape != $item->shape0->{'name_shape' . (Yii::$app->language == 'uk' ? '_ua' : '')}) {
        $shape = $item->shape0->{'name_shape' . (Yii::$app->language == 'uk' ? '_ua' : '')};
        $echo_gems_table .= '<tr><td class="shape" style="text-align:center;" colspan=7>' . $shape . '</td></tr>';
    }
    $echo_gems_table .= '<tr>
                <td class="table_img RowImgGems">
                    <a href="/shop/gems?id=' . $item->id_product . '">
                        ' . Html::img($item->thumb(50, 70)) . '
                    </a>';

    if ($item->exclusive_type || $item->this_is_nabor)
        $echo_gems_table .= Html::a('<img src="/pic/exc.png" alt="">', ['gems', 'id' => $item->id], ['class' => 'excluzive']);


    $echo_gems_table .= "
                </td>
                <td class=\"RowRzmerGems\">";
// если это круглый камушек, второй размер не вывводим
    if (in_array($item->shape0->id_shape, [1, 2, 27, 20, 7])) {
        $item->size_w = '0.00';
    }
    $echo_gems_table .= number_format($item->size_h, 2, ',', ' ') . (($item->size_w != '0.00') ? ' x ' . number_format($item->size_w, 2, ',', ' ') : '') . (($item->size_d != '0.00') ? ' x ' . number_format($item->size_d, 2, ',', ' ') : '');

    $echo_gems_table .= "</td><td class=\"RowWesGems\">
                    " . ($item->weight > 0 ? number_format($item->weight, 4, ',', ' ') : '') . "</td>
                <td  class=\"RowPriceGems\">";

    // скрываем копейки если цена больше 10$
    if ($item->cost) {
        if ($item->cost < 10)
            $echo_gems_table .= number_format($item->cost, 2, ',', ' ') . ' ' . $curr->name_currency;
        else
            $echo_gems_table .= number_format($item->cost, 0, ',', ' ') . ' ' . $curr->name_currency;

        if (isset($item->action)) {
            $echo_gems_table .= '<br><nobr><span class="red">' . Yii::t('app', 'скидка') . ' -' . $item->actionPrice . "</span></nobr>";
        }
    }

    //если админ
    if (!Yii::$app->user->isGuest) {
        if (Yii::$app->user->identity->username == 'info@gems.com.ua' OR Yii::$app->user->identity->username == 'office@novikov.ua') {
            $echo_gems_table .= '<br>
 
<a href="/admin/product-gems-prices/update?id=' . $item->id_product . '" title="Редактировать" aria-label="Редактировать" data-pjax="0"><span class="glyphicon glyphicon-pencil">EDIT</span></a> 
<a href="/admin/product-gems-prices/delete?id=' . $item->id_product . '" title="Удалить" aria-label="Удалить" data-pjax="0" data-confirm="Вы уверены, что хотите удалить этот элемент?" data-method="post"><span class="glyphicon glyphicon-trash">DEL</span></a>';
        }
    }

    $echo_gems_table .= " </td><td class=\"RowButtonGems\">";

    if (!$item->cost) {
        $echo_gems_table .= '<span class="noprice">' . Yii::t('app', 'Цену уточняйте') . '</span>';

    } else if (isset($item->stock_points) && $item->stock_points > 0) {
        $echo_gems_table .= '<a href="#" class="minus" id="subs' . $item->id . '"  onclick="return subst(' . $item->id . ')" ><img src="/pic/minus.png" alt=""></a>';
        $echo_gems_table .= '<input type="text" size="4" id="noOfRoom' . $item->id . '" name="quantity[' . $item->id . ']" value="0"/>';
        $echo_gems_table .= '<a href="#" class="plus" id="adds' . $item->id . '" onclick="return add(' . $item->id . ')"><img src="/pic/plus.png" alt=""></a>';

    } else {
        $echo_gems_table .= '<span class="nostock">' . Yii::t('app', 'Нет в наличии') . '</span>';
        //$echo_gems_table.=Html::submitButton(Yii::t('app', 'В корзину'), ['class' => 'btn btn-success', 'disabled' => 'disabled']);
    }
    $echo_gems_table .= "</td></tr>";
endforeach;


//echo "<div class='filterBredcrubs'>" . Yii::$app->controller->filterForm->getListFilters() . "</div>";

$b = Yii::$app->controller->filterForm->getListFilters();
$a = $b ? '<span>' . Yii::t('app', 'Отфильтрованы по') . ': ' . $b . '</span> ' : '';
echo "<div class='filterBredcrubs' template='shop\item'>" . $a . "</div>";

$this->title = strip_tags(Yii::t('app', 'купить') . ' ' . $b)
    . ' | ' . Yii::t('app', 'Все размеры и огранки данного цвета')
    . ' | ' . Yii::t('app', 'Купить камень в магазине Центури');


// первый символ заглавным
$fc = mb_strtoupper(mb_substr($this->title, 0, 1, 'utf-8'), 'utf-8');
$this->title = $fc . mb_substr($this->title, 1, 999, 'utf-8');

?>

<!--template shop/item.php-->
<!--views shop/item.php-->

<style>
#easy_zoom{
    width:600px;
    height:400px;
    border:5px solid #eee;
    background:#fff;
    color:#333;
    position:absolute;
    top:60px;
    left:400px;
    overflow:hidden;
    -moz-box-shadow:0 0 10px #777;
    -webkit-box-shadow:0 0 10px #777;
    box-shadow:0 0 10px #777;
    /* vertical and horizontal alignment used for preloader text */
    line-height:400px;
    text-align:center;
    }
#slider-single > li:nth-child(1n+2) { display: none }
</style>
<div class="tovarMainContent bgn">

    <div class="row">

        <div class="tovarM_col-md-1 left left_blok">
        </div>
        <!-- .tovarM_left -->
        <div class="tovarM_right col-md-11  right_blok">
            <div id='easy_zoom' style="display:none;"></div>
            <!--        <h4>xxx Натуральный драгоценный камень xxx</h4>-->
            <!--ЗДЕСЬ ВЫВОДИМ КАРТИНКУ Сущности тип+ цвет, огранку по дефыолту берем КРУГ = 1-->
            <div class="row">

                <div class="tovTimg col-md-7">
                    <div>
                        <div class="tovarSliderMainItem">
                            <ul id="slider-single">
                                <?php
                                // КОЛОРОБОКС всплывающие большие картинки colorbox

                                foreach ($shapes_id_array as $form_id) {
                                    echo '<li>
<img class="group1 jqzoom" width="280px"
data-zoom="' . $model->getImage($form_id) . '"
src="' . $model->getImage($form_id) . '" alt=""  />
</li>';
                                }
                                if (!isset($form_id))
                                    echo '<li><img src="/img-gems/no-foto.jpg" alt=""/></li>';

                                ?>

                            </ul>
                        </div>
<?/*                        <div class="thumbs">
                            <ul id="thumbs">
                                <?php
                                if (sizeof($shapes_id_array) > 1)
                                    foreach ($shapes_id_array as $shape_id) {
                                        echo '<li><img src="' . $model->getImage($shape_id) . '" alt=""/></li>';
                                    }
                                ?>
                            </ul>
                            <button type="button" class="tPrev slick-prev"><img src="/pic/prev.png" alt=""></button>
                            <button type="button" class="tNext slick-next"><img src="/pic/next.png" alt=""></button>
                        </div>
*/?>                    </div>

                </div>
                <!--        <div class="clear"></div>-->
                <div class="tovTdes col-md-5">
                    <div class="tovT"><?= $model->typeProduct->name ?> <span
                                class="small"><?= $model->colorProduct->{'name_color' . (Yii::$app->language == 'uk' ? '_ua' : '')} ?></span>
                    </div>
                    <div class="minDescr">
                        <?php if (isset($items[0])) { ?>
                            <p>
                                <?php
                                // БРЕНД !!!
                                echo (Yii::t('app', $items[0]->brand)) ? Yii::t('app', 'Категория') . ': <b>' . Yii::t('app', $items[0]->brand) . " </b > " : "";

                                // способ огранки временно скроем ибо херово определяется !!!!!!
                                // echo " < b><br > " . Yii::t('app', 'Огранка') . ": <b > ";
                                // echo ((isset($model->treatment_type) && $model->treatment_type == 2) ? Yii::t('app', 'машинная') : Yii::t('app', 'ручная')) . '</b>'; ?>
                            </p>
                        <?php } ?>
                        <?= $model->contentShort ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (!Yii::$app->user->isGuest) {
        if (Yii::$app->user->identity->username == 'info@gems.com.ua' OR Yii::$app->user->identity->username == 'office@novikov.ua')
            if (isset($_GET['id']))
                echo "<a href='/admin/products-type-color-multimedia?ProductsTypeColorMultimediaSearch%5Bproduct_type_color_id%5D=" . $_GET['id'] . "'>[ ИЗМЕНИТЬ СУЩНОСТЬ/ ДОБАВИТЬ КАРТИНКИ К ОГРАНКАМ СУЩНОСТИ ]</a>";
            else
                echo "[ Глючокс... Просьба зайти в эту сущность со страницы <a href='/shop'>ВСЕКАМНИ</a> / НАЗВАНИЕ КАМНЯ ]
<br><p style=\"color:gray \"> Это такая фича. Обрати внимание на URL этой страницы - это страница ТИПКАМНЯ, но т.к. данный тип камня содержит
всего один вариант сущностей ТИП+ГРУППАЦВЕТА, она сразу здесь открывается. Но это не родной адрес сущности</p>
";

    }
    ?>

    <!-- .tovarM_right -->
    <script>
        function add(id) {
            var a = $("#noOfRoom" + id).val();
            a++;
            if (a && a >= 1) {
                $("#subs" + id).removeAttr("disabled");
            }
            $("#noOfRoom" + id).val(a);
            return false;
        }
        ;

        function subst(id) {
            var
                b = $("#noOfRoom" + id).val();
            // this is wrong part
            if (b && b >= 1) {
                b--;
                $("#noOfRoom" + id).val(b);
            } else {
                $("#subs" + id).attr("disabled", "disabled");
            }
            return false;
        }
        ;
    </script>

    <div class="clear"></div>
    <table class="tprice">
        <?php $form = ActiveForm::begin(['action' => '/shop/add', 'method' => 'get']); ?>

        <thead>
        <tr class="table_head">
            <th class="RowImgGems br"></th>
            <th class="RowRzmerGems br"><?= Yii::t('app', 'Размер') ?>, <span class="small">мм</span></th>
            <th class="RowWesGems br"><?= Yii::t('app', 'Вес') ?>, <span class="small">карат</span></th>
            <th class="RowPriceGems br"><?= Yii::t('app', 'Цена') ?>, <span class="small">за шт</span></th>
            <th class="RowButtonGems">
                <?php echo Html::submitButton(Yii::t('app', 'Купить'), ['class' => 'buttontobuy']); ?>
            </th>
        </tr>
        </thead>

        <tbody>
        <?php
        echo $echo_gems_table;
        ?>
        </tbody>

    </table>
    <br>
    <table>

        <thead>
        <tr class="table_head">
            <th class="RowImgGems br"></th>
            <th class="RowRzmerGems br"><?= Yii::t('app', 'Размер') ?>, <span class="small">мм</span></th>
            <th class="RowWesGems br"><?= Yii::t('app', 'Вес') ?>, <span class="small">карат</span></th>
            <th class="RowPriceGems br"><?= Yii::t('app', 'Цена') ?>, <span class="small">за шт</span></th>
            <th class="RowButtonGems">
                <?php echo Html::submitButton(Yii::t('app', 'Купить'), ['class' => 'buttontobuy']); ?>
            </th>
        </tr>
        </thead>

        <?php ActiveForm::end(); ?>

    </table>

</div>


<div class="clear"></div>


<?= $this->render('_tabs', [
    'model' => $model,
    'simple' => $simple,

]) ?>

<div class="clear"></div>


<div class="text_blok">
    <div class="title">
        <span><?= Yii::t('app', 'Gems — интернет-магазин натуральных драгоценных камней') ?></span>
    </div>

    <p class="text">
        <?= $model->contentSeo ?>
    </p>

</div>

<!--template shop/item.php-->
<!--views shop/item.php-->
