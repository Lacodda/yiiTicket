<?php $this->beginContent ('//layouts/yiistrap_main'); ?>
    <div class="row-fluid">
        <div class="col-xs-12 col-sm-9">
            <?php echo $content; ?>
        </div>
        <? if (!empty($this->menu)): ?>
            <div class="col-xs-6 col-sm-3 sidebar-offcanvas">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php $this->widget (
                            'bootstrap.widgets.TbNav',
                            array (
                                'type'    => TbHtml::NAV_TYPE_LIST,
                                'stacked' => true,
                                'items'   => $this->menu,
                            )
                        ); ?>

                    </div>
                </div>
            </div>
        <? endif; ?>
    </div>
<?php $this->endContent (); ?>