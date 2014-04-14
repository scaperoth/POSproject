<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
$connection = Yii::app()->db;


$select_employee_ids_at_store = Works::model()->findAllByAttributes(array('employee_store_id' => Yii::app()->user->store_id));
$result_array = array();
foreach ($select_employee_ids_at_store as $emp) {
    array_push($result_array, $emp['store_emp_id']);
}

$criteria = new CDbCriteria;
$criteria->addInCondition('user_id', $result_array);
$employees_at_this_store = User::model()->findAll($criteria);

//get all necessary employee data using query builder to get table data
$employee_profile_model = Yii::app()->db->createCommand()
        ->select('user_id, username, f_name, l_name, permission_type, p.permission_id')
        ->from('employee e, user u, store s, permissions p , works w, has_permissions h')
        ->where(array("AND", "u.user_id = e.emp_id",
            "e.emp_id = h.usr_id",
            "h.permission_id = p.permission_id ",
            "w.store_emp_id = u.user_id ",
            "w.employee_store_id = s.store_id  ",
            "s.store_id = :store_id"), array(':store_id' => Yii::app()->user->store_id))
        ->queryAll();

 
/*
  echo"<pre>";
  print_r($employees_at_this_store);
  echo"</pre>";
 */
?>
<h1 class="page-header">Human Resources</h1>
<h2 class="sub-header">Section title</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Position</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employee_profile_model as $myemployee): ?>
                <tr>
                    <td><?= $myemployee['user_id']; ?></td>
                    <td><?= $myemployee['f_name'];?></td>
                    <td><?= $myemployee['l_name']; ?></td>
                    <td><?= $myemployee['username']; ?></td>
                    <td><?= $myemployee['permission_type']; ?></td>
                    <td><?php
                        echo BsHtml::ajaxLink('', Yii::app()->createAbsoluteUrl('manager/update'), array(
                        'cache' => true,
                        'data' => array(
                        'page'=>'hr',
                        'message' => 'clicked the AjaxLink',
                        'user_id' => $myemployee['user_id'],
                        ),
                        'type' => 'POST',
                        'success' => 'js:function(data){
                console.log(data);
                $(".modal-body").html(data);
                $("#myModal").modal("show");
            }'
                        ), array(
                        'icon' => 'pencil xs',
                        'style' => 'padding:0;
                                    background:none;
                                    border:none;
                                    box-shadow:none;',
                        ));
                        ?></td>

                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div>