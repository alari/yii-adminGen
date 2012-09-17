<?php
/**
 * @author alari
 * @since 9/17/12 5:49 PM
 */
class AdminContext extends CWidget
{
    public function run()
    {
        if(Yii::app()->user->isGuest) {
            return;
        }

        $items = Yii::app()->controller->menu;;

        foreach ($items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
                continue;
            }
        }

        if (count($items)) $this->render("adminContext", array(
            "items" => $items
        ));
    }
}
