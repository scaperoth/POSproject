<style>
p.capitalize {text-transform:capitalize;
text-indent:20px;}


h1 {text-align:center;}
</style>

<?php
/* @var $this SiteController */
  // connect to the database
  $connection = Yii::app()->db;
  $u_id = Yii::app()->user->id; 

  // computer the users total sale and get all the user information
  $user_query = "select SUM(i.price) totalSales, e.emp_id, u.f_name, u.l_name, r.salary, r.type, u.username
      from user u, employee e, item i, sale s , employee_role r
      where u.user_id = " .$u_id. " and s.sale_emp_id = u.user_id and i.item_id = s.sale_item_id and e.role_id = r.role_id and e.emp_id = u.user_id 
      group by e.emp_id";

  //connect
  $user = $connection->createCommand($user_query)->queryRow();

  // get the item information for all the items the employee has sold
  $sales_query = "SELECT i.name, i.price
                  FROM user u, employee e, sale s, item i
                  WHERE u.user_id = " .$u_id." AND e.emp_id = u.user_id and
                        e.emp_id = s.sale_emp_id AND
                        i.item_id = s.sale_item_id
                  ";

  
  $sales_command = $connection->createCommand($sales_query);
  
  // query database
  $emp_sales = $sales_command->queryAll();
  
  echo "<div class=\"col-sm-8 col-sm-offset-2 \">";
  
  if(!$user){ 
      // if there is no user information there are no sales that have been made
      echo "<br/><br/><h2 style=\'text-align:center\'>Sorry, you have not made any sales!</h2>";
  } else {
    echo "<html>";
    echo "<header><p class= capitalize><strong><r class = indent>".$user['type']."</r>:</strong></p></header>";
    echo "<body><strong>" ;
    echo "<h1>". $user['f_name'] ." ". $user['l_name']."</h1>"; 
           
          
    echo ("<br>"); 
    echo ("<p class= lead>"); 
    echo ("Username: ");
    echo ($user['username']); 
    echo ("<br>"); 
    echo ("Salary: ");
    echo("$".number_format($user['salary']));

    // print out a table of all the employee's sales with item name and price 
    echo ("<br>");
    print ("Total Sales: ");; 
    if($user['totalSales']){
     $formatted_dollars = "$".number_format($user['totalSales'], 2, '.', '');
     echo($formatted_dollars);
    } else echo("0");
     echo("</p>");
    print("  <table class = table>
                <thead>
                  <tc>
                    <th>Item Name</th>
                    <th>Price</th>
                  </tc>
                </thead>
                <tbody>"); 

    foreach ($emp_sales as $sale) {
      print("   
          <tr>
            <td>".$sale['name']."</td>
            <td>$".$sale['price']."</td>
          </tr>");   
      }

      print ("</tbody></table>");   
      echo "</strong></body>";
      echo "</html>";
  }
  
          
                
?>

</div>
