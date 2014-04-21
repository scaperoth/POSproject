<style>
p.capitalize {text-transform:capitalize;
text-indent:20px;}


h1 {text-align:center;}
</style>

<?php

 echo "<html>";
       echo "<body><strong>" ;
        echo "<h1>CHECKOUT</h1><br>";

        echo ("<p class= lead>"); 



//$loginForm = $_POST['employeeForm'];
//$username =  $loginForm['username']; 
//$pass = $loginForm['password'];

$sale_emp_id = ""; 
$sale_item_id = 1; 


$sale_cust_id = Yii::app()->user->id; 

if(isset($_GET['item_id'])){
  $sale_item_id = $_GET['item_id']; 
}

$user_store_id = "";


$connection = Yii::app()->db;

      //$isThisAUserQuery = "Select * from user where pass = \"".$pass."\" and username = \"".$username."\""; 

      //$users = $connection->createCommand($isThisAUserQuery)->queryRow();

      $itemInformationQuery = "Select distinct name, price from item where item_id = :sale_item_id;"; 

      $customerInformationQuery = "Select distinct f_name, l_name from user where user_id = :sale_cust_id;";

      $item_command = $connection->createCommand($itemInformationQuery);
      $item_command->bindParam(":sale_item_id", $sale_item_id, PDO::PARAM_STR);
      $items = $item_command->queryRow(); 

      $customer_command = $connection->createCommand($customerInformationQuery);
      $customer_command->bindParam(":sale_cust_id", $sale_cust_id, PDO::PARAM_STR);
      $customers = $customer_command->queryRow(); 

      $store_id_query = ""; 
      ?>
        <?php
          //$sale_emp_id = $users['user_id']; 
          //$store_id_query = "Select distinct employee_store_id from works where store_emp_id = ".$sale_emp_id; 
         // echo("Employee: ".$users['f_name']." ".$users['l_name']." <br>");
          echo("Customer: ".$customers['f_name']." ".$customers['l_name']."<br>"); 
          
            $english_format_number = "$".number_format($items['price'], 2, '.', '');
                echo("Item: ".$items['name']." ".$english_format_number."<br>");
                  echo("</p>");
?>
          

    
<form method="post"> 
    <input hidden name = "saleForm[cust_id]" value="<?= Yii::app()->user->id; ?>">
    <input hidden name = "saleForm[item_id]">
    <input placeholder = "employee username" name = "saleForm[emp_username]">
    <input type = "password" placeholder = "employee password" name = "saleForm[emp_password]"> 

    <button type = "submit" class="btn btn-primary">Submit</button>


</form>    