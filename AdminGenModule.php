<?php

class AdminGenModule extends CWebModule
{
    public $addControllerMenu = true;

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else
            return false;
    }

    public function getAdminLinks()
    {
        $links = array();
        // Collecting module links -- generic or overriden
        foreach (Yii::app()->getModules() as $name => $conf) {
            $module = Yii::app()->getModule($name);
            $addLinks = method_exists($module, "adminGenLinks") ? $module->adminGenLinks() : $this->getModuleAdminLinks($name);
            if(is_array($addLinks) && count($addLinks)) {
                if(!isset($addLinks[0]) || !is_array($addLinks[0])) {
                    $addLinks = array($addLinks);
                }
                foreach($addLinks as $l) $links[] = $l;
            }
        }

        // Controller admin links
        if($this->addControllerMenu) {
            $addLinks = Yii::app()->getController()->menu;
            if(is_array($addLinks) && count($addLinks)) {
                if(!isset($addLinks[0]) || !is_array($addLinks[0])) {
                    $addLinks = array($addLinks);
                }
                foreach($addLinks as $l) $links[] = $l;
            }
        }

        return $links;
    }

    public function getModuleAdminLinks($name) {
        static $moduleLinks = null;
        if(!$moduleLinks) {
            $moduleLinks = array(
                "user"=>array(
                    array('url' => Yii::app()->getModule('user')->profileUrl, 'label' => Yii::app()->getModule('user')->t("Profile"), 'visible' => !Yii::app()->user->isGuest),
                    array('url' => Yii::app()->getModule('user')->logoutUrl, 'label' => Yii::app()->getModule('user')->t("Logout") . ' (' . Yii::app()->user->name . ')', 'visible' => !Yii::app()->user->isGuest),
                )
            );
        }

        if(array_key_exists($name, $moduleLinks)) {
            return $moduleLinks[$name];
        }
        return null;
    }
}
