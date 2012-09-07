<?
$focusLinks = Yii::app()->getModule("adminGen")->focusLinks;
$focusColumned = false;
if(count($focusLinks) && !isset($focusLinks[0]['label'])) {
    $focusColumned = 12/count($focusLinks);
}
$focus = function($l){
    echo CHtml::link("<i class='icon-{$l['icon']}'></i> " . $l["label"], $l["url"], array("class" => "btn admin-gen-btn admin-gen-" . $l["role"]));
};

$links = Yii::app()->getModule("adminGen")->getLinks();
?>

<h1>Администрирование сайта</h1>

<br/>

    <?if(count($focusLinks)){?>
<h4>Основные действия</h4>

<div class="form-actions row" style="text-align: center">
    <?if($focusColumned) foreach($focusLinks as $flinks) {?>
    <div class="span<?=$focusColumned?>">
        <?array_map($focus, $flinks)?>
    </div>
    <?} else array_map($focus, $focusLinks)?>
</div>

<br/><br/>

<?}?>

<h4>Все действия</h4>
<div class="row">
    <?foreach ($links as $l) {
    echo "<div class='span4'>";
    echo "<strong>" . CHtml::link($l["label"], $l["url"] ? : "#") . "</strong><br/>";
    if (isset($l["items"])) $this->widget('zii.widgets.CMenu', array(
        'items' => $l["items"],
        'htmlOptions' => array('class' => 'nav nav-tabs nav-stacked'),
    ));
    echo "</div>";
}?>
</div>