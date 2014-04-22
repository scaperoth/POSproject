<?php

class EmployeeController extends Controller {
    public function filters() {
        return array(
            array(
                'application.filters.EmployeeFilter  - checkout',
            ),
        );
    }
   
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
      if(isset($_POST["employeeForm"])){
            //validate credentials
          $loginForm = $_POST['employeeForm'];
          $username =  $loginForm['username']; 
          $pass = $loginForm['password'];
          $emp_id = Yii::app()->user->id; 
          $connection = Yii::app()->db;
          $isThisAUserQuery = "Select user_id from user 
	 		  where user_id = ".$emp_id." 
			  and pass = \"".$pass."\"and username = \"".$username."\""; 
         $users=$connection->createCommand($isThisAUserQuery)->queryAll();
         if($users){
             $havePermissionQuery = "Select * from has_permissions where usr_id =".$emp_id." and permission_id > 1";
             $permissions = $connection->createCommand($havePermissionQuery)->queryAll(); 
             if($permissions){
	     	/*      Do checkout         */
                
                
     	     }else{ 
	         echo("That user is in our system, but doesn't have permission to check out a customer");
             }
         }else{
             echo("That username and password combo is incorrect"); 
         }

        }
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