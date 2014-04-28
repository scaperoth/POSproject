POSproject
==========

Project using [Bootstrap 3.0](http://getbootstrap.com/) and the [Yii Framework](http://www.yiiframework.com/).   
   
To learn how to use the bootstrap widgets with Yii, visit the [Yii-Bootstrap-3 Module Page](http://bootstrap3.pascal-brewing.de/) and browse through the Class Reference page.

###Other useful Links:   
- [Font Awesome](http://fontawesome.io/)
- [Google Fonts](http://www.google.com/fonts/)
- [REST API](http://code.tutsplus.com/tutorials/creating-an-api-centric-web-application--net-23417)    

##Usage
To run this website, first execute the proper sql queries in mysql. The sql queries can be found in the folder protected/models/sql. Execute them in this order: createdb.sql, populatedb.sql, createuser.sql. After you execute these files in mysql, you wil have the full database. navigate to the home page and login using an existing user, or register to create your own. 

###Item   
-	Item detail page      
        -	/item?id={item_id}     
-	Catalog         
        -	/catalog   
     
###Manager      
-	Store statistics      
        -	/stats    
-	Item control form(s)      
        -	/inventory      
-	Employee form        
        -	/hr    
     
###Employee
-	Personal statistics    
        -	/employee      
        -	 {$_POST[“{employee_id}”]}     
-	Checkout || item sale page    
        -	/checkout    
     
###User     
-	Account    
        -	/account     
        -	{$_POST[“{user_id}”]}    
-	Order history     
        -	/orders     
        -	{$_POST[“{user_id}”]}    
-	Preorder     
        -	/preorders     
        -	{$_POST[“{user_id}”]}    
   