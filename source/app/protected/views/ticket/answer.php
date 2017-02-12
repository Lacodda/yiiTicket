<?php
    /* @var $this TicketController */
    /* @var $ticket Ticket */

    $this->pageTitle = Yii::app ()->name . ' - Тикет #' . $topic_head->id;

    $this->breadcrumbs = array (
        'Тикеты' => array ('index'),
        'Тикет #' . $topic_head->id,
    );

    $this->menu = array (
        array ('label' => 'Тикеты', 'url' => array ('index')),
    );
?>

<h1>Ответ на тикет #<?= $topic_head->id ?></h1>
<div class="clearfix" style="margin-bottom: 10px"></div>

<?
    $this->widget (
        'application.components.TicketView',
        [
            'model'      => $model,
            'topic_head' => $topic_head,
            'comments'   => $comments,
        ]
    );
?>
<? $form = $this->beginWidget (
    'bootstrap.widgets.TbActiveForm',
    [
        'id'     => 'ticket-answer-form',
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    ]
); ?>

<fieldset>
    <?= $form->textAreaControlGroup ($ticketComment, 'text', array ('span' => 8, 'rows' => 5)); ?>
</fieldset>
<?= TbHtml::formActions (
    [
        TbHtml::submitButton ('Отправить', array ('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
        TbHtml::resetButton ('Сброс'),
    ]
); ?>

<?php $this->endWidget (); ?>
