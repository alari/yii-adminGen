<?php $links = Yii::app()->getModule('adminGen')->getLinks();?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo CHtml::encode(Yii::app()->name); ?>  Admin</title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/files/js/jquery.js"></script>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/files/js/bootstrap.js"></script>

    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a href="#" class="brand"><?php echo CHtml::encode(Yii::app()->name); ?> admin</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="active"><a href="/adminGen/adminGen/index">Панель</a></li>

                    <?php foreach($links as $link): ?>
                        <?php if(isset($link['items'])):?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <?php echo $link['label'] ?>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($link['items'] as $subLink): ?>
                                    <li><a href="<?php echo $subLink['url'][0] ?>"><?php echo $subLink['label'] ?></a></li>
                                    <?php endforeach ?>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="<?php echo $link['url'][0] ?>">
                                    <?php echo $link['label'] ?>
                                </a>
                            </li>
                        <?php endif ?>
                    <?php endforeach ?>

                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="row-fluid">
        <div class="span3">

            <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'Operations',
            ));
            $this->widget('zii.widgets.CMenu', array(
                'items'=>$this->menu,
                'htmlOptions'=>array('class'=>'operations'),
            ));
            $this->endWidget();
            ?>

        </div>

        <div class="span9">
            <?php echo $content; ?>
        </div>

    </div>
    <hr>

    <footer>
        <p>&copy; <a href="http://itaktika.ru/">Taktika</a> 2012</p>
    </footer>
</div>


</body>
</html>