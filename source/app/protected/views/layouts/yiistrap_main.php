<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo CHtml::encode ($this->pageTitle); ?></title>
    <meta name="description" content="<?php echo CHtml::encode ($this->pageTitle); ?>">
    <meta name="viewport" content="width=device-width">
    <?php Yii::app ()->bootstrap->register (); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app ()->request->baseUrl; ?>/css/style.css">
</head>

<body>

<?php $this->widget (
    'bootstrap.widgets.TbNavbar',
    array (
        'brandLabel' => CHtml::encode (Yii::app ()->name),
        'display'    => null,
        'collapse'   => true,
        'items'      => array (
            array (
                'class' => 'bootstrap.widgets.TbNav',
                'items' => [
                    ['label' => 'Главная', 'url' => ['/site/index']],

                    ['label' => 'Тикеты', 'url' => ['/ticket']],
                    ['label' => 'Регистрация', 'url' => ['/user/register'], 'visible' => Yii::app ()->user->isGuest],
                    ['label' => 'Вход', 'url' => ['/user/login'], 'visible' => Yii::app ()->user->isGuest],
                    [
                        'label'   => 'Выход (' . Yii::app ()->user->name . ')',
                        'url'     => ['/user/logout'],
                        'visible' => !Yii::app ()->user->isGuest,
                    ],
                ],
            ),
        ),
    )
); ?>


<div class="container">
    <? if (isset($this->breadcrumbs))
    {
        $this->widget (
            'bootstrap.widgets.TbBreadcrumb',
            array (
                'links' => $this->breadcrumbs,
            )
        );
    }
    ?>

    <div class="row row-offcanvas row-offcanvas-right">
        <?php echo $content; ?>
    </div>
</div>

<footer class="navbar-fixed-bottom">
    <div class="container">
        <p class="text-center">&copy; <a href="#"><?= CHtml::encode (Yii::app ()->name) ?></a> <?= date ('Y') ?></p>
    </div>
</footer>

</body>
</html>
