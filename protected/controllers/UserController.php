<?php

class UserController extends Controller {

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