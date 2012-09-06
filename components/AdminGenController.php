<?php
/**
 * @author alari
 * @since 9/6/12 7:58 PM
 */
class AdminGenController extends CController
{
    public function run($actionID) {
        if(in_array($actionID, array(
            "admin", "manage", "create", "update"
        ))) {
            $this->layout = "adminGen.views.layouts.main";
        }
        parent::run($actionID);
    }
}
