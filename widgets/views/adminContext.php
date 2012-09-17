<?php
/**
 * @author alari
 * @since 9/17/12 5:53 PM
 */
$this->widget('zii.widgets.CMenu', array(
    'itemCssClass' => 'e-admin-gen-context',
    'htmlOptions' => array('class' => 'b-admin-gen-context'),
    'itemTemplate' => '<span class="e-admin-gen-button">{menu}</span>',

    'items' => $items
));