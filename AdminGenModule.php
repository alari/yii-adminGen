<?php

class AdminGenModule extends CWebModule
{
    public $addControllerMenu = true;

    private $assets;

    public function init() {
        $this->assets = Yii::app()->getAssetManager()->publish(__DIR__ . DIRECTORY_SEPARATOR . 'assets');
    }

    public function getLinks()
    {
        $links = array();
        foreach (Yii::app()->getModules() as $name => $conf) if($name != 'user') {
            $module = Yii::app()->getModule($name);
            $addLinks = method_exists($module, "adminGenLinks") ? $module->adminGenLinks() : $this->getModuleAdminLinks($name);
            if (is_array($addLinks) && count($addLinks)) {
                if (!isset($addLinks[0]) || !is_array($addLinks[0])) {
                    $addLinks = array($addLinks);
                }
                foreach ($addLinks as $l) {
                    if (!array_key_exists("visible", $l)) {
                        $l["visible"] = !Yii::app()->user->isGuest;
                    }
                    $links[] = $l;
                }
            }
        }

        return $links;
    }

    public function getAdminLinks()
    {
        $links = array();
        // Collecting module links -- generic or overriden
        foreach (Yii::app()->getModules() as $name => $conf) {
            $module = Yii::app()->getModule($name);
            $addLinks = method_exists($module, "adminGenLinks") ? $module->adminGenLinks() : $this->getModuleAdminLinks($name);
            if (is_array($addLinks) && count($addLinks)) {
                if (!isset($addLinks[0]) || !is_array($addLinks[0])) {
                    $addLinks = array($addLinks);
                }
                foreach ($addLinks as $l) {
                    if (!array_key_exists("visible", $l)) {
                        $l["visible"] = !Yii::app()->user->isGuest;
                    }
                    $links[] = $l;
                }
            }
        }

        // Controller admin links
        if ($this->addControllerMenu) {
            $addLinks = Yii::app()->getController()->menu;
            if (is_array($addLinks) && count($addLinks)) {
                if (!isset($addLinks[0]) || !is_array($addLinks[0])) {
                    $addLinks = array($addLinks);
                }
                foreach ($addLinks as $l) {
                    if (!array_key_exists("visible", $l)) {
                        $l["visible"] = !Yii::app()->user->isGuest;
                    }
                    $links[] = $l;
                }
            }
        }

        return $links;
    }

    public function getModuleAdminLinks($name)
    {
        static $moduleLinks = null;
        if (!$moduleLinks) {
            $moduleLinks = array(
                "user" => array(
                    array('url' => Yii::app()->getModule('user')->profileUrl, 'label' => Yii::app()->getModule('user')->t("Profile"), 'visible' => !Yii::app()->user->isGuest),
                    array('url' => Yii::app()->getModule('user')->logoutUrl, 'label' => Yii::app()->getModule('user')->t("Logout") . ' (' . Yii::app()->user->name . ')', 'visible' => !Yii::app()->user->isGuest),
                )
            );
        }

        if (array_key_exists($name, $moduleLinks)) {
            return $moduleLinks[$name];
        }
        return null;
    }

    public function populateAdminAssets() {
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript("jquery");
        $cs->registerCssFile($this->assets . '/css/bootstrap.css');
        $cs->registerScriptFile($this->assets . '/js/bootstrap.js');
    }
}
