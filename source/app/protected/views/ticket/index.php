<?php
    /* @var $this TicketController */
    /* @var $dataProvider CActiveDataProvider */

    $this->breadcrumbs = [
        'Тикеты',
    ];

    $this->menu = [
        ['label' => 'Открыть тикет', 'url' => ['open']],
    ];

?>

<h1>Тикеты</h1>

<div class="clearfix" style="margin-bottom: 10px"></div>

<? $this->widget (
    'bootstrap.widgets.TbGridView',
    [
        'dataProvider' => $dataProvider,
        'template'     => "{items}{pager}",
        'columns'      => [
            [
                'name'   => 'id',
                'header' => '#',
            ],
            [
                'name'   => 'date_modified',
                'header' => 'Обновлено',
            ],
            [
                'name'   => 'department',
                'header' => 'Раздел',
                'value'  => function ($ticket)
                {
                    return $ticket->departments[$ticket['department']];
                },
            ],
            [
                'name'   => 'topic',
                'header' => 'Тема',
            ],
            [
                'name'   => 'status',
                'header' => 'Статус',
                'value'  => function ($ticket)
                {
                    return sprintf (
                        '<div class="%s">%s</div>',
                        $ticket->statuses[$ticket['status']]['class'],
                        $ticket->statuses[$ticket['status']]['name']
                    );
                },
                'type'   => 'html',
            ],
            [
                'class'    => 'CButtonColumn',
                'template' => '{view}{answer}',
                'buttons'  => [
                    'view'   => [
                        'label'    => '<i class="glyphicon glyphicon-eye-open"></i> Просмотр',
                        'imageUrl' => false,
                        'url'      => 'Yii::app()->createUrl("ticket", ["view"=>$data->id])',
                        'options'  => ['title' => '', 'class' => 'btn btn-sm'],
                        'visible'  => 'in_array($data->status,[0,2])',
                    ],
                    'answer' => [
                        'label'    => '<i class="glyphicon glyphicon-ok-circle"></i> Ответить',
                        'imageUrl' => false,
                        'url'      => 'Yii::app()->createUrl("ticket", ["answer"=>$data->id])',
                        'options'  => ['title' => '', 'class' => 'btn btn-sm'],
                        'visible'  => 'in_array($data->status,[1])',
                    ],
                ],
            ],
        ],

    ]
); ?>

