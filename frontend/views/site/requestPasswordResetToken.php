<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Форма восстановления пароля');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::t('app', 'Укажите ваш E-mail на который будет выслана ссылка для восстановления пароля') ?></p>

    <div class="row">
        <div class="col-lg-10">
            <?php $form = ActiveForm::begin([
                'id' => 'request-password-reset-form',
                'options' => ['class' => 'regform'],
            ]); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
