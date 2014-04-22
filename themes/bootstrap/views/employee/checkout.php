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
    

if (!isset($_POST['employeeForm'])): ?>
<form method="post"> 
    
    <input placeholder = "employee username" name = "employeeForm[username]">
    <input type = "password" placeholder = "employee password" name = "employeeForm[password]"> 

    <button type = "submit" class="btn btn-primary">Submit</button>


</form> 
<?php else: ?>
Attempting to check out <?= (isset($_GET['item_id']))? "item " .$_GET['item_id'] : "nothing"; ?>

<?php 
 $sale_attempt = "INSERT INTO sale ('sale_cust_id', 'sale_item_id', 'sale_store_id', 'sale_emp_id') VALUES ('" .Yii::app()->user->id."', '". $_GET['item_id'] . "', '". Yii::app()->user->store_id ."', '". 3 . "');";



endif; ?>