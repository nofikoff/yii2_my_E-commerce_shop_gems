<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Регистрация');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <!--    <p>--><? //= Yii::t('app', 'Заполните для регистрации') ?><!--:</p>-->

    <div class="row">
        <div class="col-lg-3">
        </div>
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin([
                'id' => 'form-signup',
                'options' => ['class' => 'regform'],
            ]); ?>

            <!--            --><? //= $form->field($model, 'username')->Label('E-mail')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'email')
                ->textInput()->input('email', ['placeholder' => "Email"])->label(false)


            ?>
            <!--            <input type="hidden" name="SignupForm[email]" value="nomail@novikov.ua">-->

            <?= $form->field($model, 'name')->textInput()->input('text', ['placeholder' => "Имя"])->label(false) ?>
            <?= $form->field($model, 'phone')->textInput()->input('text', ['placeholder' => "Телефон"])->label(false) ?>
            <?= $form->field($model, 'address')->textInput()->input('text', ['placeholder' => "Почтовый адрес"])->label(false) ?>
            <?= $form->field($model, 'password')->textInput()->input('password', ['placeholder' => "Пароль"])->label(false) ?>

            <!--            --><? //= $form->field($model, 'name')->Label(Yii::t('app', 'Имя')) ?>
            <!--            --><? //= $form->field($model, 'phone')->Label(Yii::t('app', 'Телефон')) ?>
            <!--            --><? //= $form->field($model, 'address')->Label(Yii::t('app', 'Почтовый адрес')) ?>
            <!--            --><? //= $form->field($model, 'password')->Label(Yii::t('app', 'Пароль'))->passwordInput() ?>


            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Зарегистрироваться'), ['class' => 'btn btn-primary left', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-3">
        </div>

    </div>
</div>
