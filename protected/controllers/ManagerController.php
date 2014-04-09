<?php

class ManagerController extends Controller
{   
        
       public $layout='//layouts/managerlayout';
	public function actionIndex()
	{
		$this->render('dashboard');
	}
        
        /************************
         *     MANAGER PAGES
         ************************/
        /**
         * 
         */
         public function actionDashboard()
	{
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('dashboard');
	}        
        /**
         * 
         */
        public function actionInventory()
	{
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('inventory');
	}
        /**
         * 
         */
        public function actionHr()
	{
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('hr');
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