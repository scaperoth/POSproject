<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
$connection = Yii::app()->db;
//query for order information
$order_query = "SELECT *
 				FROM item
 				WHERE item_id IN (SELECT sale_item_id FROM sale WHERE sale_cust_id= " . Yii::app()->user->id . ");";
//command
$order_command = $connection->createCommand($order_query);
//order array
$order = $order_command->queryAll();				 
$order_command->reset();
$itemarray = array();

foreach ($order as $item) {
    $itemarray[] = array(
        'id' => $item['item_id'],
        'name' => $item['name'],
        'price' => $item['price'],
        'sale_price' => $item['sale_price'],
        'release_date' => $item['release_date'],
    );
}
$gridDataProvider_item = new CArrayDataProvider($itemarray);
?>
<h1 class="page-header">order Info for <?= Yii::app()->user->lname; ?></h1>
<?php
$this->widget('bootstrap.widgets.BsGridView', array(
    'dataProvider' => $gridDataProvider_item
    ,
    'id' => uniqid('table_'),
    'columns' => array(
        array('name' => 'name', 'header' => 'Item Name'),
        array('name' => 'price', 'header' => 'Price'),
        array('name' => 'sale_price', 'header' => 'Sale Price'),
    ),
    'type' => BsHtml::GRID_TYPE_STRIPED
));
?>