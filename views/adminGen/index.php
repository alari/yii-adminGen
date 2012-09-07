<?
$focusLinks = Yii::app()->getModule("adminGen")->focusLinks;
$links = Yii::app()->getModule("adminGen")->getLinks();
?>

    <h1>Администрирование сайта</h1>


    <br/>

        <h4>Основные действия</h4>

<div class="form-actions">
    <?foreach($focusLinks as $l) {?>
        <?=CHtml::link("<i class='icon-{$l['icon']}'></i> ".$l["label"], $l["url"], array("class"=>"btn btn-".$l["role"]))?>
<?}?>
</div>

    <br/><br/>

    <h4>Все действия</h4>
    <div class="row">
        <?foreach($links as $l) {
        echo "<div class='span4'>";
        echo "<strong>".CHtml::link($l["label"], $l["url"]?:"#")."</strong><br/>";
        if(isset($l["items"]))$this->widget('zii.widgets.CMenu', array(
            'items' => $l["items"],
            'htmlOptions' => array('class' => 'nav nav-tabs nav-stacked'),
        ));
        echo "</div>";
    }?>
    </div>