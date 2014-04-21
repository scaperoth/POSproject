<?php
 /* @var $this SiteController */
$u_id = "";
            
                

                	
                	if(isset($_GET["id"]))
                    $u_id =  $_GET["id"];

              
              	$sql = "SELECT distinct f_name, l_name, emp_id, username, salary, type, user_id FROM user, employee, employee_role";
              

              	$connection = Yii::app()->db;

				$command=$connection->createCommand($sql);

				$users=$connection->createCommand($sql)->queryAll();


/*
        $sales= Yii::app()->db->createCommand()
          -> select ('*') 
          -> from ('sale')
          -> queryRow(); */

        foreach($users as $u){
          if($u_id == $u['user_id']) {
          echo "<html>";
           echo "<header><strong>Employee</strong></header>";
            echo "<body><strong>" ;
            echo "Name: ";
            echo $u['f_name'];
            echo ($u['l_name']); 
            echo ("<br>"); 
             echo ("Username: ");
            echo ($u['username']); 
            echo ("<br>"); 
             echo ("salary: ");
            echo($u['salary']);
            echo ("<br>");
            echo ("Role: ");
            echo($u['type']); /*
            foreach($sales as $sale){
              if($sale['sale_emp_id'] == $u['emp_id']){
                echo ("<br>");
                echo ("Total Sales: ");; 
                echo ($sale['total_Sales']); 
              }

            }*/
            
            
         echo "</strong></body>";
          echo "</html>";
            break; 
           
          }
        }

        /*echo (" "); 
            echo ($u['l_name']); 
            echo ("\n"); 
             echo ("username: ");
            echo ($u['username']); 
            echo ("salary: ");
            echo($u['salary']); */


        //print_r($users);
				
              
              //$output = User::model()->findAll();
			 // print_r($output);
             	

                //echo $user.f_name;
                

                
               
?>
