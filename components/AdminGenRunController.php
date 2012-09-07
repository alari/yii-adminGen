<?php
/**
 * @author alari
 * @since 9/6/12 7:58 PM
 */
class AdminGenRunController extends CController
{
    public function run($actionID) {
        $id = $this->id."/".$actionID;
        if($this->module) {
            $id = $this->module->id."/".$id;
        }
        $override = Yii::app()->getModule("adminGen")->override;
        foreach($override as $l) {
            if($this->endsWith($id, $l)) {
                $this->layout = "adminGen.views.layouts.main";
                break;
            }
        }
        parent::run($actionID);
    }

    private function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }
}
