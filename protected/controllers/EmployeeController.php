<?php

class EmployeeController extends Controller {

    public function actionIndex() {
        $this->render('employee');
    }

    /*     * **********************
     *     EMPLOYEE PAGES
     * ********************** */

    public function actionEmployee() {
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('employee');
    }

    public function actionCheckout() {
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('checkout');
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