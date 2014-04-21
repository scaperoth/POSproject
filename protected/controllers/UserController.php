<?php

class UserController extends Controller {
    
    public function filters() {
        return array(
            array(
                'application.filters.UserFilter - register',
            ),
        );
    }
    
    public function actionIndex() {
        $this->render('account');
    }

    /***********************
     *     USER PAGES
     * ********************** */
    
    public function actionAccount() {
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('account');
    }

    public function actionOrders() {
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('orders');
    }

    public function actionPreorders() {
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('preorders');
    }
	
    public function actionRegister() {
       $model=new Register();

		// collect user input data
		if(isset($_POST['Register']))
		{
			$model->attributes=$_POST['Register'];
			if($model->validate() &&$model->save())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('register',array('model'=>$model));
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