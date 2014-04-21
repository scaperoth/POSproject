<?php
if(!isset($_GET['item_id'])){
    header( 'Location: catalog' );
    die();
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$connection = Yii::app()->db;

/***************************************************
*  Queries for this page
****************************************************/

$safe_id = mysql_real_escape_string($_GET['item_id']);

if(isset($safe_id)){
    $item_info_query = "select name, price, release_date, sale_price 
		   	   from item 
			   where item_id = $safe_id";
    $item_info_command = $connection->createCommand($item_info_query);
    $item_info =  $item_info_command->queryRow();
    $item_info_command->reset();

    $item_quantity_query = "SELECT SUM(quantity) from store_item 
    			   where item_store_id = $safe_id";
    $item_quantity_command = $connection->createCommand($item_quantity_query);
    $item_quantity = $item_quantity_command->queryRow();
    $item_quantity_command->reset();
}
 
?>
<h1 class="page-header">Item detail</h1>
<br/>
<br/>
<?php if(!strcmp($item_info['name'], '')): ?>
   Internal error: Item not found
   <br/>
   Return to <a href='catalog'>Item Catalog?</a>
   
<?php else:  ?>

<h4>Item: <?= $item_info['name']?></h4>
<h4>Price: $<?=number_format($item_info['price'], 2, '.', ' '); ?></h4>
<h4>Quantity: <?= $item_quantity['SUM(quantity)'] ?></h4>
<?php endif; ?>
<h6>
<?php
  $prev = $safe_id - 1;
  $next = $safe_id +1;
  echo "<a href=item?item_id=".$prev.">previous item</a>";
  echo "| <a href=item?item_id=" . $next . ">next item</a>";

?>
</h6>
