<?php
$links = Yii::app()->getModule('adminGen')->getLinks();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo CHtml::encode(Yii::app()->name); ?>  Admin</title>
    <?Yii::app()->getModule("adminGen")->populateAdminAssets()?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a href="/" class="brand"><?php echo CHtml::encode(Yii::app()->name); ?> admin</a>

            <div class="nav-collapse">
                <ul class="nav">
                    <li><?=CHtml::link("Панель", array("/adminGen/adminGen/index"))?></li>

                    <? foreach ($links as $link) { ?>
                    <? if (isset($link['items'])) { ?>
                        <li class="dropdown">
                            <?=CHtml::link($link['label'] . '<b class="caret"></b>', $link['url'] ? : "#", array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'))?>
                            <?$this->widget('zii.widgets.CMenu', array(
                            'items' => $link['items'],
                            'htmlOptions' => array('class' => 'dropdown-menu'),
                        ));?>
                        </li>
                        <? } else { ?>
                        <li>
                            <?=CHtml::link($link['label'], $link['url'])?>
                        </li>
                        <? } ?>
                    <? }?>

                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="row-fluid">

        <div class="span8 offset1">
            <?php echo $content; ?>
        </div>

        <div class="span2">

            <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title' => 'Operations',
            ));
            $this->widget('zii.widgets.CMenu', array(
                'items' => $this->menu,
                'htmlOptions' => array('class' => 'nav nav-tabs nav-stacked'),
            ));
            $this->endWidget();
            ?>

        </div>

    </div>
    <hr>

    <footer>
        <p>&copy; Компания <a href="http://itaktika.ru/">Тактика</a> <?=date("Y")?></p>
    </footer>
</div>


</body>
</html>