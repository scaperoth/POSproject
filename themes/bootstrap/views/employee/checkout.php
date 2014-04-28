<style>
p.capitalize {text-transform:capitalize;
text-indent:20px;}


h1 {text-align:center;}

</style>


  <div class="col-sm-4 col-sm-offset-4 ">
<?php

 echo "<html>";
       echo "<body><strong>" ;
        echo "<h1>CHECKOUT</h1><br>";

        echo ("<p class= lead>"); 


$sale_emp_id = ""; 
$sale_item_id = 1; 


//get the user id from the database 
$sale_cust_id = Yii::app()->user->id; 

// check to see if the id is given in the url
if(isset($_GET['item_id'])){
  $sale_item_id = $_GET['item_id']; 
}

$user_store_id = "";

// connect to the database 
$connection = Yii::app()->db;

      // get the information for the items being sold
      $itemInformationQuery = "Select distinct name, price from item where item_id = :sale_item_id;"; 
      // get the information for the customer purchasing these items
      $customerInformationQuery = "Select distinct f_name, l_name from user where user_id = :sale_cust_id;";
      
      //query the database
      $item_command = $connection->createCommand($itemInformationQuery);
      $item_command->bindParam(":sale_item_id", $sale_item_id, PDO::PARAM_STR);
      $items = $item_command->queryRow(); 
      
      // query the database
      $customer_command = $connection->createCommand($customerInformationQuery);
      $customer_command->bindParam(":sale_cust_id", $sale_cust_id, PDO::PARAM_STR);
      $customers = $customer_command->queryRow(); 

      $store_id_query = ""; 
      ?>
        <?php
          //print customer info
          echo("Customer: ".$customers['f_name']." ".$customers['l_name']."<br>"); 
          
            // make sure the price is formated as a dollar amount
            $english_format_number = "$".number_format($items['price'], 2, '.', '');
                echo("Item: ".$items['name']." ".$english_format_number."<br>");
                  echo("</p>");
?>
          

    
<form method="post"> 
    <input hidden name = "saleForm[cust_id]" value="<?= Yii::app()->user->id; ?>">
    <input hidden name = "saleForm[item_id]" value="<?= $sale_item_id; ?>">
    <input placeholder = "employee username" name = "saleForm[emp_username]">
    <input type = "password" placeholder = "employee password" name = "saleForm[emp_password]"> 

    <button type = "submit" class="btn btn-primary">Submit</button>


</form>    
</div>
