<?php
    /* @var $this UserController */
    /* @var $model UserLogin */
    /* @var $form CActiveForm */

    $this->pageTitle = Yii::app ()->name . ' - Вход';

    $this->breadcrumbs = ['Вход'];
?>

<h1>Вход</h1>
<p class="muted"> Вы можете войти под учетной записью администратора: <code>admin/admin</code></p>
<p class="muted"> Вы можете войти под учетной записью пользователя: <code>user/user</code></p>
<div class="clearfix" style="margin-bottom: 10px"></div>
<?
    if (Yii::app ()->user->checkAccess ('administrator'))
    {
        echo "hello, I'm administrator";
    }
?>

<? $form = $this->beginWidget (
    'bootstrap.widgets.TbActiveForm',
    [
        'id'     => 'user-login-form',
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    ]
); ?>

<fieldset>
    <?= $form->textFieldControlGroup ($model, 'login', ['help' => '']); ?>
    <?= $form->passwordFieldControlGroup ($model, 'password', ['help' => '']); ?>
    <?= $form->checkBoxControlGroup ($model, 'rememberMe', array ('1' => false)); ?>
</fieldset>
<?= TbHtml::formActions (
    [
        TbHtml::submitButton ('Отправить', array ('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
        TbHtml::resetButton ('Сброс'),
    ]
); ?>

<?php $this->endWidget (); ?>


