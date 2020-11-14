<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Simpleproducts */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['class'=>'form-horizontal', 
'action'=>Url::toRoute(['simpleproducts/buy','id'=>$model->id])]); ?>

    <?=Html::input('submit','submit','Add to cart',[
                'class'=>'button add',

              ])?>
<?php ActiveForm::end(); ?>
