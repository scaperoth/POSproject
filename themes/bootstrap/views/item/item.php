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
date_default_timezone_set('America/New_York');

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
$quant =  ($item_quantity['SUM(quantity)'] ) ? $item_quantity['SUM(quantity)'] : "Out of Stock";
 
?>
<script type="text/javascript">
<!-- 
function delayedRedirect(){
    window.location = "catalog"
}
//-->
</script>	 


<h1 class="page-header">Item detail</h1>
<br/>
<br/>
<?php if(!strcmp($item_info['name'], '')): ?>
   <body onLoad="setTimeout('delayedRedirect()', 5000)">
   Internal error: Item not found
   <br/>
   Returning to item catalog. <a href='catalog'>Click here</a> if you are not redirected.
   </body>
   
<?php else:  ?>
      <?php
          $item_image =  Yii::app()->theme->baseUrl.'/assets/images/item_'.$safe_id . '.jpg';

          Echo "<img src=" . $item_image . " onerror=this.src=\"".Yii::app()->theme->baseUrl."/assets/images/default.jpg\"><br/>";

      ?>
      <h4>Item: <?= $item_info['name']?></h4>
      <h4>Price: $<?=number_format($item_info['price'], 2, '.', ' '); ?></h4>
      <h4>Quantity Available: <?=$quant ?></h4>
<?php endif; ?>
<h6>
<?php 

  if($item_info['release_date']!= '' && $item_info['release_date'] > date('Y-m-d H:i:s')){
      echo "Item available on " . $item_info['release_date']. "<br/>";
      echo "<a href=../user/preorders?item_id=$safe_id class=\"btn btn-primary\">Click to Preorder</a>";	
  }else{
      echo "<a href=../employee/checkout?item_id=$safe_id class=\"btn btn-primary\">Click to Purchase</a> ";
  }

  echo "<br/><br/><br/>";
  $prev = $safe_id - 1;
  $next = $safe_id +1;
  echo "<a href=item?item_id=".$prev.">previous item</a>";
  echo "| <a href=item?item_id=" . $next . ">next item</a>";

?>
</h6>