<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// item and the users name 
// validate employee credentials


$item_id=-1;
// use a form to get and validate the password
if(isset($_GET['item_id']))
$item_id = $_GET ['item_id'];


$sql = "insert into sale VALUES ";
    


?>

<form method="post"> 
    
    <input placeholder = "employee username" name = "employeeForm[username]">
    <input type = "password" placeholder = "employee password" name = "employeeForm[password]"> 

    <button type = "submit" class="btn btn-primary">Submit</button>


</form> 
 
