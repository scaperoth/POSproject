<style>
p.capitalize {text-transform:capitalize;
text-indent:20px;}


h1 {text-align:center;}
</style>

<?php
/* @var $this SiteController */
  $connection = Yii::app()->db;
  $u_id = Yii::app()->user->id; 

  $user_query = "select SUM(i.price) totalSales, e.emp_id, u.f_name, u.l_name, r.salary, r.type, u.username
      from user u, employee e, item i, sale s , employee_role r
      where u.user_id = " .$u_id. " and s.sale_emp_id = u.user_id and i.item_id = s.sale_item_id and e.role_id = r.role_id and e.emp_id = u.user_id 
      group by e.emp_id";

  $user = $connection->createCommand($user_query)->queryRow();

  $sales_query = "SELECT i.name, i.price
                  FROM user u, employee e, sale s, item i
                  WHERE u.user_id = " .$u_id." AND e.emp_id = u.user_id and
                        e.emp_id = s.sale_emp_id AND
                        i.item_id = s.sale_item_id
                  ";


  $sales_command = $connection->createCommand($sales_query);

  $emp_sales = $sales_command->queryAll();
  ?>
  <div class="col-sm-8 col-sm-offset-2 ">
  <?
  if(!$user) echo ("<br/><br/><h2 style='text-align:center;'>Sorry, you have not made any sales!</h2>");
  else {
    echo "<html>";
    echo "<header><p class= capitalize><strong><r class = indent>".$user['type']."</r>:</strong></p></header>";
    echo "<body><strong>" ;
    echo "<h1>";
    echo $user['f_name'];
    echo(" ");
    echo ($user['l_name']); 
    echo "</h1>"; 
           
          
    echo ("<br>"); 
    echo ("<p class= lead>"); 
    echo ("Username: ");
    echo ($user['username']); 
    echo ("<br>"); 
    echo ("Salary: ");
    echo("$".number_format($user['salary']));

    //foreach($emp_sales as $sale){ 
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