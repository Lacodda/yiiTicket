<?php
    /* @var $this TicketController */
    /* @var $ticket Ticket */

    $this->pageTitle = Yii::app ()->name . ' - Открыть тикет';

    $this->breadcrumbs = array (
        'Тикеты' => array ('index'),
        'Открыть',
    );

    $this->menu = array (
        array ('label' => 'Тикеты', 'url' => array ('index')),
    );
?>

    <h1>Открыть тикет</h1>
    <div class="clearfix" style="margin-bottom: 10px"></div>
<? $form = $this->beginWidget (
    'bootstrap.widgets.TbActiveForm',
    [
        'id'     => 'ticket-open-form',
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    ]
); ?>

    <fieldset>
        <?= $form->textFieldControlGroup ($ticket, 'topic', ['help' => '']); ?>
        <?= $form->dropDownListControlGroup (
            $ticket,
            'department',
            $ticket->departments,
            [
                'help' => '',
            ]
        ); ?>
        <?= $form->textAreaControlGroup($ticketComment, 'text', array('span' => 8, 'rows' => 5)); ?>
    </fieldset>
<?= TbHtml::formActions (
    [
        TbHtml::submitButton ('Отправить', array ('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
        TbHtml::resetButton ('Сброс'),
    ]
); ?>

<?php $this->endWidget (); ?>