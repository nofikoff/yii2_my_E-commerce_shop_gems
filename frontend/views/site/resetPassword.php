<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Сброс пароля');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::t('app', 'Укажите ваш новый пароль') ?></p>

    <div class="row">
        <div class="col-lg-10">

            <?php $form = ActiveForm::begin([
                'id' => 'reset-password-form',
                'options' => ['class' => 'regform'],
            ]); ?>

                <?= $form->field($model, 'password')->Label(Yii::t('app', 'Пароль'))->passwordInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
