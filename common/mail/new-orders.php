<?php
use yii\helpers\Html;

/* @var $this yii\web\View */


?>
<div class="password-reset">

    <h3 style="color: #5e9ca0;">Товары:</h3>
    <div style="padding-left: 30px;">
        <?php
        echo "<table border='1'><tr><td>Камень<td>Размер<td>Вес<td>Цена<td>Количество";
        foreach ($positions as $position) {
            if (!isset($position->product->name)) continue;

            // если это круглый камушек, второй размер не вывводим
            if (in_array($position->product->shape0->id_shape, [1, 2, 27, 20, 7])) {
                $position->product->size_w = '0.00';
            }
            $size = number_format($position->product->size_h, 2, '.', ' ') . (($position->product->size_w != '0.00') ? ' x ' . number_format($position->product->size_w, 2, '.', ' ') : '') . (($position->product->size_d != '0.00') ? ' x ' . number_format($position->product->size_d, 2, '.', ' ') : '');
            echo '<tr><td><a href="https://gems.ua/shop/gems?id=' . $position->product->id_product . '">' . $position->product->name . '</a> 
<td>' . $size . ' <td>' . $position->product->weight . ' <td>' . $position->price . ' грн - <td>' . $position->quantity . 'шт. ';
        }
        echo "</table>";

        ?>

    </div>

    <h3 style="color: #5e9ca0;">Контакт:</h3>
    <div style="padding-left: 30px;">
        <?= nl2br($contacts) ?>
    </div>

    <h3 style="color: #5e9ca0;">Комментарий к заказу:</h3>
    <div style="padding-left: 30px;">
        <?= $comments ?>
    </div>


</div>
<hr>
С уважением,<br>
Интернет магазин Gems.ua<br>
+38 (044) 592 14 88,<br>
+38 (050) 207 75 54 <br>
<a href='mailto:info@gems.com.ua'>info@gems.com.ua</a><br>
