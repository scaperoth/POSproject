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



$loginForm = $_POST['employeeForm'];
$username =  $loginForm['username']; 
$pass = $loginForm['password'];

$sale_emp_id = ""; 
$sale_item_id = 1; 


$sale_cust_id = Yii::app()->user->id; 

if(isset($_GET['item_id'])){
	$sale_item_id = $_GET['item_id']; 
}

$user_store_id = "";


$connection = Yii::app()->db;

      $isThisAUserQuery = "Select * from user where pass = \"".$pass."\" and username = \"".$username."\""; 

      $users = $connection->createCommand($isThisAUserQuery)->queryAll();

      $itemInformationQuery = "Select distinct name, price from item where item_id = ".$sale_item_id; 

      $customerInformationQuery = "Select distinct f_name, l_name from user where user_id = ".$sale_cust_id; 

      $items = $connection->createCommand($itemInformationQuery)->queryAll(); 

      $customers = $connection->createCommand($customerInformationQuery)->queryAll(); 

      $store_id_query = ""; 

      if($users){
      	foreach($users as $user){
      		$sale_emp_id = $user['user_id']; 
      		$store_id_query = "Select distinct employee_store_id from works where store_emp_id = ".$sale_emp_id; 
      		echo("Employee: ".$user['f_name']." ".$user['l_name']." <br>");
      		foreach($customers as $c) echo("Customer: ".$c['f_name']." ".$c['l_name']."<br>"); 
      		foreach($items as $i){
      			$english_format_number = "$".number_format($i['price'], 2, '.', '');
                echo("Item: ".$i['name']." ".$english_format_number."<br>");
                  echo("</p>");
      		}   
      	}
      	$stores = $connection->createCommand($store_id_query)->queryAll(); 
        foreach($stores as $s){
      		$user_store_id = $s['employee_store_id']; 
      		print (" <form name=checkout method=submittPressed>
						<input type=submit value=checkout>
                     </form>"






      			);
      		/*$sale_Insert_Query = "INSERT into sale VALUES($sale_cust_id,$sale_item_id,$user_store_id,$sale_emp_id)"; 
			$inserted_Sale = $connection->createCommand$sale_Insert_Query)->queryAll();*/ 
      	}
      }

     

?>