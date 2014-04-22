<?php
$connection = Yii::app()->db;
$all_items_query = "select item_id, name, price, sale_price, release_date, SUM(quantity)
                              from item i, store_item s 
                              where i.item_id = s.store_item_id
			      group by item_id";

		   
		 
$all_items_command = $connection->createCommand($all_items_query);

$all_items = $all_items_command->queryAll();

$itemarray = array();

foreach ($all_items as $item){
    if( isset($item['sale_price']) ){
        $quant = ($item['SUM(quantity)']) ? $item['SUM(quantity)'] : "Out of Stock";
	$itemarray[] = array(
      	    'id' => $item['item_id'],
	    'name' => $item['name'],
            'price' =>$item['sale_price'],
	    'release_date' => $item['release_date'],
	    'quantity' => $quant
	    
	    );

    }else{
        $itemarray[] = array(
            'id' => $item['item_id'],
	    'name' => $item['name'],
            'price' =>$item['price'],
	    'release_date' => $item['release_date'],
	    'quantity' => $item['SUM(quantity)']
	    );
    }
}


?>

<h1 class="page-header">Site Catalog</h1>
<legent>Item Catalog</legent>
<div class="table-responsive">
     <table class="table table-striped" id="catalog_table">
     	    <thead>
		<tr>
			<th>Name</th>
			<th>Price</th>
			<th>Available</th>
			<th>Quantity</th>
		</tr>
	    </thead>
	    <tbody>
	        <?php foreach ($all_items as $item): ?>
		      <tr>
			<td><?php 
			        echo "<a href=item?item_id=". $item['item_id']. ">". $item['name'] . "</a>"; 
			    ?></td>
			<td>$<?= number_format($item['price'],2,'.', ' '); ?></td>
			<td><?= $item['release_date']; ?></td>
			<td><?= $item['SUM(quantity)']; ?></td>
		      </tr>
		<?php endforeach; ?>
	    </tbody>
	</table>
</div>			


