<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Авторизация');
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="login">
    <div class="title"><span><?= Yii::t('app', 'Вход в личный кабинет') ?></span></div>
    <div class="login_blok bg_line">
        <div class="fTitle"><?= Yii::t('app', 'Постоянным покупателям') ?>:</div>
        <span class="sma mb"><?= Yii::t('app', 'Если у Вас уже есть аккаунт, пожалуйста введите') ?>:</span>
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'regform'],
        ]); ?>


        <?= $form->field($model, 'username')->textInput()->input('text', ['placeholder' => "E-mail"])->label(false) ?>
        <?= $form->field($model, 'password')->textInput()->input('password', ['placeholder' => Yii::t('app', 'Пароль')])->label(false) ?>
        <?= $form->field($model, 'rememberMe')->Label(false)->checkbox()->label(Yii::t('app', 'Запомнить меня')) ?>
        <?php
        if (isset($_GET['backurl'])) {
            echo "<input type='hidden' name='backurl' value='".$_GET['backurl']."'>";
        }
        ?>


        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Войти'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <div class='center'>
            <?= Yii::t('app', 'Для восстановления пароля') ?>
            &nbsp; <?= Html::a(Yii::t('app', 'перейдите по ссылке'), ['site/request-password-reset']) ?>
        </div>

        <?php ActiveForm::end(); ?>


    </div>
    <div class="login_blok">
        <div class="fTitle"><?= Yii::t('app', 'Новые клиенты') ?></div>
        <span class="sma mb"><?= Yii::t('app', 'Создайте личный кабинет! Вы сможете быстрее оформлять заказы, просматривать историю и иметь доступ к накопительным скидкам') ?>
            .</span>

        <?php $form = ActiveForm::begin([
            'id' => 'form-signup',
            'options' => ['class' => 'regform'],
        ]); ?>

        <!--            --><? //= $form->field($model, 'username')->Label('E-mail')->textInput(['autofocus' => true]) ?>
        <?= $form->field($modelSignupForm, 'email')
            ->textInput()->input('email', ['placeholder' => "Email"])->label(false)


        ?>
        <!--            <input type="hidden" name="SignupForm[email]" value="nomail@novikov.ua">-->

        <?= $form->field($modelSignupForm, 'name')->textInput()->input('text', ['placeholder' => Yii::t('app', 'Имя Фамилия')])->label(false) ?>
        <?= $form->field($modelSignupForm, 'phone')->textInput()->input('text', ['placeholder' => Yii::t('app', 'Телефон')])->label(false) ?>
        <?= $form->field($modelSignupForm, 'address')->textInput()->input('text', ['placeholder' => Yii::t('app', 'Почтовый адрес')])->label(false) ?>
        <?= $form->field($modelSignupForm, 'password')->textInput()->input('password', ['placeholder' => Yii::t('app', 'Пароль')])->label(false) ?>

        <!--            --><? //= $form->field($model, 'name')->Label(Yii::t('app', 'Имя')) ?>
        <!--            --><? //= $form->field($model, 'phone')->Label(Yii::t('app', 'Телефон')) ?>
        <!--            --><? //= $form->field($model, 'address')->Label(Yii::t('app', 'Почтовый адрес')) ?>
        <!--            --><? //= $form->field($model, 'password')->Label(Yii::t('app', 'Пароль'))->passwordInput() ?>
        <?php
        if (isset($_GET['backurl'])) {
            echo "<input type='hidden' name='backurl' value='".$_GET['backurl']."'>";
        }
        ?>


        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Зарегистрироваться'), ['class' => 'btn btn-primary left', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>


    </div>

</div>

