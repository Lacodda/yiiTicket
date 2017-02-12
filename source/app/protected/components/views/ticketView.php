<?php
    $template = '<div class="panel panel-warning">
<div class="panel-heading"><h3 class="panel-title">%s: %s%s</h3></div>
<div class="panel-body">%s</div>%s
</div>';

    $status = sprintf (
        '<div class="%s pull-right">%s</div>',
        $this->model->statuses[$this->topic_head->status]['class'],
        $this->model->statuses[$this->topic_head->status]['name']
    );

    $topicHead = sprintf (
        '<dl class="dl-horizontal">
<dt>ID</dt>
<dd>%s</dd>
<dt>Раздел</dt>
<dd>%s</dd>
<dt>Тема</dt>
<dd>%s</dd>
<dt>Запрос</dt>
<dd>%s</dd>
</dl>',
        $this->topic_head->id,
        $this->model->departments[$this->topic_head->department],
        $this->topic_head->topic,
        $this->topic_head->ticketComment[0]->text
    );

    $listGroup = '<ul class="list-group">%s</ul>';

    $listItem = '<li class="list-group-item %s">%s: %s</li><li class="list-group-item">%s</li>';

    if (!empty($this->comments))
    {
        $list = '';
        foreach ($this->comments as $comment)
        {
            $color = $this->topic_head->user_id == $comment->user_id ? 'list-group-item-warning' : 'list-group-item-success';
            $list .= sprintf ($listItem, $color, $comment->user->login, $comment->date_create, $comment->text);
        }
        $listGroup = sprintf ($listGroup, $list);
        printf ($template, $this->topic_head->user->login, $this->topic_head->date_create, $status, $topicHead, $listGroup);
    } else
    {
        printf ($template, $this->topic_head->user->login, $this->topic_head->date_create, $status, $topicHead, '');
    }