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
        if(isset($_POST["employeeForm"])){
            //validate credentials
          $loginForm = $_POST['employeeForm'];
          $username =  $loginForm['username']; 
          $pass = $loginForm['password'];


      $connection = Yii::app()->db;

      $isThisAUserQuery = "Select * from user where pass = \"".$pass."\" and username = \"".$username."\""; 

      $users = $connection->createCommand($isThisAUserQuery)->queryAll();

      if($users){
        foreach($users as $user){
           $havePermissionQuery = "Select * from has_Permissions where usr_id = ".$user['user_id']." and permission_id > 1";
          $permissions = $connection->createCommand($havePermissionQuery)->queryAll(); 
          if($permissions) {
           echo("Success");
           $this->render("checkoutScreen");
           die();  
          }else echo("That user is in our system, but doesn't have permission to check out a customer"); 
        }


      }
      else {
        foreach($users as $a) {
          echo($a['pass']);
        } 
        echo("That username and password combo is incorrect"); 
        


      }


         

        

          
    

          
        // using the default layout 'protected/views/layouts/main.php'
       

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