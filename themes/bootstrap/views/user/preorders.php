<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
$connection = Yii::app()->db;
//query for preorder information
$preorder_query = "SELECT *
 				   FROM item
 				   WHERE item_id IN (SELECT preorder_item_id FROM pre_order WHERE preorder_cust_id= " . Yii::app()->user->id . ");";
//command
$preorder_command = $connection->createCommand($preorder_query);
//preorder array
$preorder = $preorder_command->queryAll();				 
$preorder_command->reset();
$itemarray = array();

foreach ($preorder as $item) {
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
  <div class="col-sm-8 col-sm-offset-2 ">
<h1 class="page-header">Preorder Info for <?= Yii::app()->user->lname; ?></h1>
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
    'type' => BSHtml::GRID_TYPE_STRIPED
));
?>
</div>