<?php

class AdminGenController extends Controller
{

	public $layout='/layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

        $baseDir = dirname(__FILE__);
        $assets = Yii::app()->getAssetManager()->publish($baseDir . DIRECTORY_SEPARATOR . '../assets');

        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($assets . '/css/bootstrap.css');
        $cs->registerScriptFile($assets . '/js/jquery.js');
        $cs->registerScriptFile($assets . '/js/bootstrap.js');


        $this->render('index');

	}

}
