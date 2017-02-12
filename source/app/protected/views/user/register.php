<?php
    /* @var $this UserController */
    /* @var $model User */
    /* @var $form CActiveForm */

    $this->pageTitle = Yii::app ()->name . ' - Регистрация';

    $this->breadcrumbs = ['Регистрация'];
?>

    <h1>Регистрация</h1>
    <div class="clearfix" style="margin-bottom: 10px"></div>
<? $form = $this->beginWidget (
    'bootstrap.widgets.TbActiveForm',
    [
        'id'                     => 'user-register-form',
        'enableAjaxValidation'   => true,
        'enableClientValidation' => true,
        'layout'                 => TbHtml::FORM_LAYOUT_HORIZONTAL,
    ]
); ?>

    <fieldset>
        <?= $form->textFieldControlGroup ($model, 'login', ['help' => '']); ?>
        <?= $form->textFieldControlGroup ($model, 'password', ['help' => '']); ?>
        <?= $form->textFieldControlGroup ($model, 'email', ['help' => '']); ?>
        <?= $form->textFieldControlGroup (
            $model,
            'verifyCode',
            array (
                'help'           => 'Введите проверочный код с картинки.',
                'controlOptions' => array ('before' => $this->widget ('system.web.widgets.captcha.CCaptcha', array (), true) . '<br/>'),
            )
        ); ?>
    </fieldset>
<?= TbHtml::formActions (
    [
        TbHtml::submitButton ('Отправить', array ('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
        TbHtml::resetButton ('Сброс'),
    ]
); ?>

<?php $this->endWidget (); ?>