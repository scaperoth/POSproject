<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<?php

 $autocomplete = $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
	'name'=>'createfname',
	'value'=>$model->f_name,
//	'source'=>$people, // <- use this for pre-set array of values
	'source'=>$this->createUrl('manager/getNames'),// <- path to controller which returns dynamic data
	// additional javascript options for the autocomplete plugin
        
	'options'=>array(
            'showAnim'=>'fold',
		'minLength'=>'1', // min chars to start search
            'response'=>'js:function( event, ui ) {
                       
                    }',
            'select'=>'js:function(event, ui) { 
                        event.preventDefault();
                        console.log(1 +":"+ui.item.f_name); 
                        
                        $("#createfname").val(ui.item.f_name);
                        $("#createlname").val(ui.item.l_name);
                        $("#createusername").val(ui.item.username);
                        $("#createpassword").val(ui.item.pass);
                        console.log("CHANGE");
                    }'
	),
        
	'htmlOptions'=>array(
		'id'=>'createfname',
		'rel'=>'val',
                'class'=>'form-control',
                'placeholder'=>'First Name',
                'type'=>'text',
	),
), true);

 
$createModalid = 'createModal';

$createModalBody = '
<div class="form-group">
    <label for="userfname">First Name</label>
    '.$autocomplete.'
</div>
<div class="form-group">
    <label for="userlname">Last Name</label>
    <input type="text" class="form-control" id="createlname" placeholder="Last Name">
</div>
<div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="createusername" placeholder="Username">
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="createpassword" placeholder="Password">
</div>          
';

$updateModalid = 'updateModal';


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

<h1 class="page-header">Human Resources for Store #<?= Yii::app()->user->store_id; ?></h1>
<div data-toggle="tooltip" title="Add New User" data-placement="left" >
    <a class="modal_link" href="#?javascript:void(0);" data-toggle="modal" data-target="#<?= $createModalid; ?>">
        <i class="fa fa-plus-circle fa-lg fa-fw"></i> 
        New
    </a>
</div>

<h2 class="sub-header">Section title</h2>
<div class="table-responsive">
    <table class="table table-striped" id="emp_table">
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
                    <td><?= $myemployee['f_name']; ?></td>
                    <td><?= $myemployee['l_name']; ?></td>
                    <td><?= $myemployee['username']; ?></td>
                    <td><?= $myemployee['permission_type']; ?></td>
                    <td><?php
                        echo BSHtml::ajaxLink('&nbsp;', Yii::app()->createAbsoluteUrl('manager/hr'), array(
                            'cache' => true,
                            'data' => array(
                                'ajax' => 'update',
                                'user_id' => $myemployee['user_id'],
                                'user_role'=>$myemployee['permission_type'],
                            ),
                            'type' => 'POST',
                            'success' => 'js:function(data){
                                            console.log(data);
                                            $("#' . $updateModalid . ' .modal-body").html(data);
                                            $("#' . $updateModalid . ' .modal-body").attr("data_id","'.$myemployee['user_id'].'");
                                            $("#' . $updateModalid . '").modal("show");
                                         }'
                                ), array(
                            'icon' => 'edit fw',
                            'data-toggle' => "tooltip",
                            'title' => 'edit',
                            'style' => 'padding:0;
                                    background:none;
                                    border:none;
                                    box-shadow:none;',
                        ));
                        echo BSHtml::ajaxLink('', Yii::app()->createAbsoluteUrl('manager/delete'), array(
                            'cache' => true,
                            'data' => array(
                                'page' => 'hr',
                                'user_id' => $myemployee['user_id'],
                            ),
                            'type' => 'POST',
                            'success' => 'js:function(data){
                                            console.log(data);
                                            location.reload();
                                         }',
                                ), array(
                            'icon' => 'trash-o fw',
                            'onclick'=>'if(!confirm("are you sure?")) throw new Error("Request Canceled")',
                            'data-toggle' => "tooltip",
                            'title' => 'delete',
                            'style' => 'padding:0;
                                    background:none;
                                    border:none;
                                    box-shadow:none;',
                        ));
                        ?>


                    </td>

                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
    <?php
    $this->widget('bootstrap.widgets.BsModal', array(
        'id' => $updateModalid,
        'header' => 'Modal Heading',
        'content' => '<p>One fine body...</p>',
        'footer' => array(
            BSHtml::ajaxLink('Save Changes', Yii::app()->createAbsoluteUrl('manager/update'), array(
                'cache' => true,
                'data-dismiss' => 'modal',
                'data' => array(
                    'page' => 'hr',
                    'user_id' => 'js:$("#' . $updateModalid . ' .modal-body").attr("data_id")',
                    'fname' => 'js:$("#updatefname").val()',
                    'lname' => 'js:$("#updatelname").val()',
                    'username' => 'js:$("#updateusername").val()',
                    'pass' => 'js:$("#updatepass").val()',
                    'role'=>'js:$("#updaterole").val()',
                ),
                'type' => 'POST',
                'success' => 'js:function(data){
                              console.log(data);
                              $("#' . $updateModalid . '").modal("hide");
                              location.reload();
                            }',
                    ), array(
                'class' => 'btn btn-primary',
            )),
            BSHtml::button('Cancel', array(
                'data-dismiss' => 'modal',
            )),
        )
    ));

    $this->widget('bootstrap.widgets.BsModal', array(
        'id' => $createModalid,
        'header' => 'Modal Heading',
        'content' => $createModalBody,
        'footer' => array(
            BSHtml::ajaxLink('Save Changes', Yii::app()->createAbsoluteUrl('manager/create'), array(
                'class' => 'btn btn-primary',
                'cache' => true,
                'data-dismiss' => 'modal',
                'data' => array(
                    'page' => 'hr',
                    'fname' => 'js:$("#createfname").val()',
                    'lname' => 'js:$("#createlname").val()',
                    'username' => 'js:$("#createusername").val()',
                    'pass' => 'js:$("#createpassword").val()',
                ),
                'type' => 'POST',
                'success' => 'js:function(data){
                                  console.log(data);
                                  $("#' . $createModalid . '").modal("hide");
                                  $("#' . $createModalid . '").on("hidden.bs.modal", function () {
                                        location.reload();
                                    });
                                      
                               }',
                    ), array(
                'class' => 'btn btn-primary',
                    )
            ),
            BSHtml::button('Cancel', array(
                'data-dismiss' => 'modal',
            )),
        )
    ));
    ?>

<?php
 
 
$js = "jQuery('#createfname')";
        $js .= ".data( 'ui-autocomplete' )._renderItem = function( ul, item ) {
            
            return $( '<li></li>' )
                .data( 'item.autocomplete', item )
                .append( '<a>' + item.f_name + ' '+ item.l_name +'<br><b>Uname: </b>' + item.username + ' <b>ID:</b>' + item.user_id + '</a>' )
                .appendTo( ul );
        };";
 
        $cs = Yii::app()->getClientScript();
        $cs->registerScript(__CLASS__.'#CtaCte_alumno_', $js);
?>
</div>