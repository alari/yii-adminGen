<?php

class AdminGenModule extends CWebModule
{
	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

    public function getAdminLinks() {
        foreach(Yii::app()->getModules() as $module) {

        }
        return Yii::app()->getController()->menu;
    }
}
