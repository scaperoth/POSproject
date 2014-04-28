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
            //validate credentials entered on page against the database
            $saleForm = $_POST['saleForm'];
            $username =  $saleForm['emp_username']; 
            $pass = $saleForm['emp_password'];
            //connecting to the database
            $connection = Yii::app()->db;
            $isThisAUserQuery = "Select * from user where pass = \"$pass\" and username = \"$username\""; 
            //querrying database
            $employee = $connection->createCommand($isThisAUserQuery)->queryRow();

	    // you can't continue if there is no employee information
            if($employee){
            	// if the user is an employee their permissions will be 2 or 3 
                $havePermissionQuery = "Select * from has_permissions where usr_id = ".$employee['user_id']." and permission_id > 1";
                $permissions = $connection->createCommand($havePermissionQuery)->queryRow(); 
                if(!empty($permissions)) {
                    //this is the store id for the employee that just logged in
                    $store_id = Works::model()->findByAttributes(array("store_emp_id"=>$employee['user_id']));

                    //insert sale using employee id, $employee['user_id'], customer id from the form, $saleForm['user_id'] and the same for the item id
                    $customer_id = $saleForm['cust_id'];
                    $item_id = $saleForm['item_id'];
                    if($item_id != -1){
                    	// item id is set to -1 at the beginning, if it's retrieved by the _GET it will no longer be -1
                        $newSale = new Sale();
                        // take all the information we just gathered and store it in an instance of the model
                        $newSale->sale_emp_id = $employee['user_id']; 
                        $newSale->sale_cust_id = $customer_id; 
                        $newSale->sale_store_id = $store_id['employee_store_id'];
                        $newSale->sale_item_id = $item_id; 
                        $newSale->save();
                        // if the sale is succesfully saved you will be taken back to the homepage and a message will be displayed
                        Yii::app()->user->setFlash("success","This sale has been made");
                        $this->redirect(array('/site/'));
                    }else{
                    	// we want to avoid added malformed tuples to our database
                        echo("A sale with no item was submitted, but not processed. Try Again!");
                    }
                } else 
                	// permissions level of 1 is just a customer and shouldn't be on this page 
	            echo("That user is in our system, but doesn't have permission to check out a customer"); 
            }else 
	        echo("That username and password combo is incorrect"); 
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
