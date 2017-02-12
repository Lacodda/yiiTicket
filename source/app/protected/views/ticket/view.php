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

<h1>Просмотр тикета #<?= $topic_head->id ?></h1>
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
