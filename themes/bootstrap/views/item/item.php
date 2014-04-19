<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$connection = Yii::app()->db;

/***************************************************
*  Queries for this page
****************************************************/

$safe_id;
if (isset($_GET['item_id'])){
    $safe_id = mysql_real_escape_string($_GET['item_id']);
}

if (isset($safe_id) ) {
    $item_info_query = "select name, price, release_date, sale_price 
		   	   from item 
			   where item_id = $safe_id";
    $item_info_command = $connection->createCommand($item_info_query);
    $item_info =  $item_info_command->queryRow();
    $item_info_command->reset();

    $item_quantity_query = "SELECT SUM(quantity) from store_item 
    			   where item_store_id = $safe_id)";
    $item_quantity_command = $connection->createCommand($item_quantity_query);
    $item_quantity = $item_quantity_command->queryAll();
    $item_quantity_command->reset();
}
?>
