<? if (count($items)) { ?>
<div class="b-admin-panel">
    <a href="#" class="e-admin-navigation-button">Show Admin Panel</a>
    <h4 class="e-admin-panel-header"><?=CHtml::link("Администрирование", array("/adminGen/adminGen/index"))?></h4>

    <?
    $this->widget('zii.widgets.CMenu', array(
        'itemCssClass' => 'e-admin-nav-item',
        'htmlOptions' => array('class' => 'b-admin-navigation'),
        'itemTemplate' => '<span class="e-admin-nav-button">{menu}</span>',

        'items' => $items
    ));
    ?>
</div>
<? } ?>