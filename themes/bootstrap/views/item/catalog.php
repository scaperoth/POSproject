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
	$itemarray[] = array(
      	    'id' => $item['item_id'],
	    'name' => $item['name'],
            'price' =>$item['sale_price'],
	    'release_date' => $item['release_date'],
	    'quantity' => $item['SUM(quantity)']
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

$gridDataProvider_item = new CArrayDataProvider($itemarray);
?>

<h1 class="page-header">Site Catalog</h1>
<legent>Item Catalog</legent>
<?php
$this->widget('bootstrap.widgets.BsGridView', array(
    'dataProvider' => $gridDataProvider_item
    ,
    'id' => uniqid('table_'),
    'columns' => array(
	array('name' => 'name', 'header' => 'Name'),
	array('name' => 'price', 'header' => 'Price'),
	array('name' => 'release_date', 'header' => 'Available Starting'),
	array('name' => 'quantity', 'header' => 'Quantity available'),
    ),
    'type' => BSHtml::GRID_TYPE_STRIPED
));
?>

