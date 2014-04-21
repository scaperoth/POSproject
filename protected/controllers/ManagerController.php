<?php

class ManagerController extends Controller {

    public function filters() {
        return array(
            array(
                'application.filters.ManagerFilter',
            ),
        );
    }

    public $layout = '//layouts/managerlayout';

    public function actionIndex() {
        $this->render('dashboard');
    }

    /*     * **********************
     *     MANAGER PAGES
     * ********************** */

    /**
     * 
     */
    public function actionDashboard() {
// using the default layout 'protected/views/layouts/main.php'
        $this->render('dashboard');
    }

    /**
     * 
     */
    public function actionInventory() {
// using the default layout 'protected/views/layouts/main.php'
        $this->render('inventory');
    }

    /**
     * 
     */
    public function actionHr() {
        if (isset($_POST['ajax']) == 'update') {
            $roles = EmployeeRole::model()->findAll();
            $option = '';
            $userid = $_POST['user_id'];
            $user_role = $_POST['user_role'];
            $user = User::model()->findByPk($userid);
            
            foreach($roles as $role){
                $selected = '';
                if($user_role == $role['type'])
                    $selected = 'selected';
                $option .= "<option $selected value='{$role['type']}'>{$role['type']}</option>";
            }
            
            echo <<< UPDATE
<div class="form-group">
    <label for="userfname">First Name</label>
    <input type="text" class="form-control" id="updatefname" placeholder="First Name" value="{$user['f_name']}">
</div>
<div class="form-group">
    <label for="userlname">Last Name</label>
    <input type="text" class="form-control" id="updatelname" placeholder="Last Name" value="{$user['l_name']}">
</div>
<div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="updateusername" placeholder="Username" value="{$user['username']}">
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="updatepass" placeholder="Password" value="{$user['pass']}">
</div>
<div class="form-group">
    <label for="updaterole">Employee Role</label>
    <select id="updaterole" class="form-control">
        $option
    </select> 
</div>
UPDATE;
        } else if (isset($_POST['ajax']) == 'create') {
            
        } else {
            $model = new User();
// using the default layout 'protected/views/layouts/main.php'
            $this->render('hr',array('model'=>$model));
        }
    }
    
   public function actionGetNames () {

	if (isset($_GET['term'])) {
            
                $res =array();
		// http://www.yiiframework.com/doc/guide/database.dao
		$qtxt ="SELECT f_name, l_name, user_id, username, pass FROM user WHERE f_name LIKE :f_name and user_id not in (select emp_id FROM employee);";
		$command =Yii::app()->db->createCommand($qtxt);
		$command->bindValue(":f_name", '%'.trim($_GET['term']).'%', PDO::PARAM_STR);
		$res =$command->queryAll();
                
                echo CJSON::encode($res);
	}

	Yii::app()->end();
    }

    public function actionUpdate() {
         if ($_POST['page'] == 'hr') {
            try {
                if (array_search('', $_POST) !== false)
                    throw new Exception("Please fill out all fields.");

                $userid = $_POST['user_id'];
                $fname = trim($_POST['fname']);
                $lname = trim($_POST['lname']);
                $username = trim($_POST['username']);
                $pass = trim($_POST['pass']);
                $role = trim($_POST['role']);
                                
                //translate text into proper integers for permissions
                $role_id = EmployeeRole::model()->findByAttributes(array("type"=>"$role"));
                $permission_id = Permissions::model()->findByAttributes(array("permission_type"=>"$role"));
                
                $user = User::model()->findByPk($userid);
                $emp = Employee::model()->findByAttributes(array("emp_id"=>$userid));
                $haspermissions = HasPermissions::model()->findByAttributes(array("usr_id"=>$userid));

                $user->f_name = $fname;
                $user->l_name = $lname;
                $user->username = $username;
                $user->pass = $pass;
                $user->update();

                $emp->role_id = $role_id['role_id'];
                $emp->update();

                $haspermissions->permission_id = $permission_id['permission_id'];
                $haspermissions->update();
                

                Yii::app()->user->setFlash('success', 'User Updated.');
            } catch (Exception $e) {
                Yii::app()->user->setFlash('danger', 'Error.');
                echo '{"error": "' . $e . '"}';
            }
        }
    }

    public function actionDelete() {
        if ($_POST['page'] == 'hr') {
            try {
                $pk = $_POST['user_id'];
                $changepermissions = HasPermissions::model()->findByAttributes(array('usr_id'=>$pk));
                $changepermissions->permission_id = 1;
                $changepermissions->save();
                        
                $remove_employee = Employee::model()->findByAttributes(array('emp_id'=>$pk));
                $remove_employee->delete();
                $remove_employee->save();
                
                $works = Employee::model()->findByAttributes(array('store_emp_id'=>$pk));
                $works->delete();
                $works->save();
                Yii::app()->user->setFlash('success', 'User Deleted.');
            } catch (Exception $e) {
                
            }
        }
    }

    public function actionCreate() {
        if ($_POST['page'] == 'hr') {
            try {
                if (array_search('', $_POST) !== false)
                    throw new Exception("Please fill out all fields.");

                $fname = trim($_POST['fname']);
                $lname = trim($_POST['lname']);
                $username = trim($_POST['username']);
                $pass = trim($_POST['pass']);
                $checkModel = User::model()->findByAttributes(array('username'=>$username));
                if($checkModel===null) {
                    $user = new User();
                    $user->f_name = $fname;
                    $user->l_name = $lname;
                    $user->username = $username;
                    $user->pass = $pass;
                    $user->save();
                    $pk = $user->primaryKey;
                } else {  
                    $pk = $checkModel['user_id'];
                }
                
                $permissions = HasPermissions::model()->findByAttributes(array('usr_id'=>$pk));
                $emp = new Employee();
                $works = new Works();

                $emp->emp_id = $pk;
                $emp->role_id = 1;
                $emp->save();

                $permissions->usr_id = $pk;
                $permissions->permission_id = 2;
                $permissions->update();

                $works->store_emp_id = $pk;
                $works->employee_store_id = Yii::app()->user->store_id;
                $works->save();

                Yii::app()->user->setFlash('success', 'User Added.');
                
                
            } catch (Exception $e) {
                Yii::app()->user->setFlash('danger', 'Undefined Error.');
                echo '{"error": "' . $e . '"}';
            }
        }
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