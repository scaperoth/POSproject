<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
$connection = Yii::app()->db;
//query for user information
$userinfo_query = "SELECT *
 				   FROM user
 				   WHERE user_id= " . Yii::app()->user->id . ";";
//command
$userinfo_command = $connection->createCommand($userinfo_query);
//userinfo array
$userinfo = $userinfo_command->queryRow();				 
$userinfo_command->reset();
$userinfo_array = array(
	'username' => $userinfo['username'],
    'lastname' => $userinfo['l_name'],
    'firstname' => $userinfo['f_name'],
)
?>
<h1 class="page-header">User Account for <?= Yii::app()->user->lname; ?></h1>
<div class="row placeholders col-sm-offset-2">
    <div class="col-xs-6 col-sm-2 placeholder">
        <h4>First Name</h4> 
        <span class="text-muted"><?= $userinfo_array['firstname']?></span>
    </div>
    <div class="col-xs-6 col-sm-2 placeholder">
        <h4>Last Name</h4>
        <span class="text-muted"><?= $userinfo_array['lastname']?></span>
    </div>
    <div class="col-xs-6 col-sm-2 placeholder">
        <h4>User Name</h4>
        <span class="text-muted"><?= $userinfo_array['username']?></span>
    </div>
