<?php
/**
 * @author alari
 * @since 8/14/12 3:55 PM
 */
class AdminCorner extends CWidget
{
    public function run(){
        // Get assets dir
        $baseDir = dirname(__FILE__);
        $assets = Yii::app()->getAssetManager()->publish($baseDir . DIRECTORY_SEPARATOR . 'assets');

        // Publish required assets
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($assets.'/b-admin-panel.css');

        $this->render("adminCorner", array(
            "items"=>Yii::app()->getModule("adminGen")->getAdminLinks()
        ));
    }
}
