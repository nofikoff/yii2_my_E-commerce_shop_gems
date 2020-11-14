<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Upload Excel: ' . $model->id_product;
$this->params['breadcrumbs'][] = ['label' => 'Product Gems Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_product, 'url' => ['view', 'id' => $model->id_product]];
$this->params['breadcrumbs'][] = 'Upload';
?>
<div class="product-gems-prices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="product-gems-prices-form">



    <pre>Пример файла выгрузки  <a href="/_examples/003.xlsx">003.xlsx</a>
Привязка полей БД происходит к букве названия соответствующего столбика Экселя.
Выпадающее поле ниже в форме "Бренды" - обязательное!
Если цена не указана, позиция в магазине помечается как "Цену уточняйте"
Эксклюзив и наборы - здесь Бренд МОЖНО указывать "ДРУГИЕ БРЕНДЫ" чтобы не смешивать с дешевыми.
Поле K - необязательное поле, признак что это ЭКСКЛЮЗИВ если =1, или НАБОР если >1
Обязательными полями остаются :  тип + цвет + форма + размер + вес - эти же пераметры используются для определения уникальной позиции
    </pre>


        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
        echo $form->field($model, 'file')->fileInput();
        echo "<br>";


        echo '<label class="control-label" for="channels-remark_admin">Бренд импортируемых камней (из него определяется тип обработки и признак искусствености)</label>';
        echo "<br>";
        echo '<label class="control-label" for="channels-remark_admin">Для ЭКСКЛЮЗИВНЫХ камней выбрать "Другие бренды" - чтобы не путались с Модельными и пр</label>';
        echo "<br>";
        echo '<label class="control-label" for="channels-remark_admin">Эксклюзивные камни -  определяется автоматом по бОльшему колву полей XLS</label>';
        echo Html::dropDownList('ProductGemsPrices[brand]', '', $enum_list,
            [
                'prompt' => '-Выбрать-',
                'class' => 'form-control'
            ]);
        echo "<br>";
        /*

                echo '<label class="control-label" for="channels-remark_admin">Тип огранки</label>';
                echo Html::dropDownList('ProductGemsPrices[treatment_type]', '',
                    [
                        '0'=>'Машинная',
                        '1'=>'Ручная',
                    ],
                    [
                        'prompt' => '-Выбрать-',
                        'class' => 'form-control'
                    ]);
                echo "<br>";

                echo '<label class="control-label" for="channels-remark_admin">Происхождение камня</label>';
                echo Html::dropDownList('ProductGemsPrices[synthetic_type]', '',
                    [
                        '0'=>'Натуральный',
                        '1'=>'Искусственный',
                    ],
                    [
                        'prompt' => '-Выбрать-',
                        'class' => 'form-control'
                    ]);
                echo "<br>";*/

        //        echo '<label class="control-label" for="channels-remark_admin">Эксклюзивные камни -  определяется автоматом по бОльшему колву полей XLS</label> ';
        //        echo Html::checkbox('ProductGemsPrices[exclusive_flag]');
        echo "<br>";
        echo "<br>";
        echo "<br>";

        ?>

        <?= Html::submitButton('Загрузить/анализировать Excel БЕЗ сохранения в БД', ['class' => 'btn btn-primary']) ?>
        <button type="submit" name='save_to_base' class="btn btn-success">Загрузить/анализировать Excel и сохранить
            ЦЕНПОЗИЦИИ в
            БД
        </button>
        <br><br>


        <button type="submit" name='save_images_type_color' class="btn btn-success">КАРТИНКИ (инициализация редко) из
            прайса ЦЕНПОЗИЦИЙ - для СУЩНОСТЕЙ ТипКамня+Цвет Загрузить в БД
        </button>
        <button type="submit" name='drop_base' class="btn btn-danger">Очистить таблицу камней в БД</button>

        <?php ActiveForm::end(); ?>
    </div>

</div>
