<?php

class EmployeeController extends Controller {
    public function filters() {
        return array(
            array(
                'application.filters.EmployeeFilter  - checkout',
            ),
        );
    }
    /*     * **********************
     *     EMPLOYEE PAGES
     * ********************** */

    public function actionEmployee() {
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('employee');
    }

    public function actionCheckout() {
        if(isset($_POST["saleForm"])){
            //validate credentials
          $saleForm = $_POST['saleForm'];
          $username =  $saleForm['emp_username']; 
          $pass = $saleForm['emp_password'];


      $connection = Yii::app()->db;

      $isThisAUserQuery = "Select * from user where pass = \"".$pass."\" and username = \"".$username."\""; 

      $employee = $connection->createCommand($isThisAUserQuery)->queryRow();




      if($employee){
          $havePermissionQuery = "Select * from has_permissions where usr_id = ".$employee['user_id']." and permission_id > 1";
          $permissions = $connection->createCommand($havePermissionQuery)->queryRow(); 
          if(!empty($permissions)) {
                //this is the store id for the employee that just logged in
                $store_id = Works::model()->findByAttributes(array("store_emp_id"=>$employee['user_id']));

                //insert sale using employee id, $employee['user_id'], customer id from the form, $saleForm['user_id'] and the same for the item id
                $customer_id = $saleForm['cust_id'];
                $item_id = $saleForm['item_id'];



                if($item_id != -1){
                  $newSale = new Sale();
                  $newSale->sale_cust_id = $customer_id; 
                  $newSale->sale_emp_id = $employee['user_id']; 
                  $newSale->sale_store_id = $store_id['employee_store_id'];
                  $newSale->sale_item_id = $item_id; 
                  $newSale->save();

                   Yii::app()->user->setFlash("success","This sale has been made");
             $this->redirect(array('/site/'));

                } else {
                  echo("A sale with no item was submitted, but not processed. Try Again!");
                }

                
          } else echo("That user is in our system, but doesn't have permission to check out a customer"); 
      }
      else echo("That username and password combo is incorrect"); 
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