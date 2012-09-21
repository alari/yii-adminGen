<?php
/**
 * @author alari
 * @since 9/6/12 7:58 PM
 */
class AdminGenRunController extends CController
{
    protected $adminLayout = "adminGen.views.layouts.main";
    private $adminGenId;
    private $isOverriden = false;

    public function run($actionID)
    {
        $this->adminGenId = $this->id . "/" . $actionID;

        if ($this->module) {
            if (isset($this->module->adminGenOverride) && is_array($this->module->adminGenOverride)) {
                $this->isOverridenWithin($this->module->adminGenOverride);
            }
            $this->adminGenId = $this->module->id . "/" . $this->adminGenId;
        }
        $this->isOverridenWithin(Yii::app()->getModule("adminGen")->override);
        parent::run($actionID);
    }

    private function isOverridenWithin(array $override)
    {
        if (!$this->isOverriden) foreach ($override as $l) {
            if ($this->isOverridenBy($l)) return $this->isOverriden = true;
        }
        return false;
    }

    private function isOverridenBy($mask)
    {
        if ($mask == $this->adminGenId
            || $this->endsWith($this->adminGenId, $mask)
            || ($mask[strlen($mask) - 1] == "*" && $this->startsWith($this->adminGenId, substr($mask, 0, -1)))) {
            $this->layout = $this->adminLayout;
            return true;
        }
        return false;
    }

    private function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }

    private function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }
}
