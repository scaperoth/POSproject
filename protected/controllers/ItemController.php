<?php

class ItemController extends Controller
{
	public function actionIndex()
	{
		$this->render('item');
	}
        
        /************************
         *     ITEM PAGES
         ************************/
        public function actionItem()
	{
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('item');
	}
        
         public function actionCatalog()
	{
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('catalog');
	}
        
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}