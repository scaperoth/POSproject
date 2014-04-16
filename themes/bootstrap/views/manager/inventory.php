<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
$connection = Yii::app()->db;

/* * *************************************************
 * Queries used on this page
 * ************************************************* */
//get all the equipment for the current store
$store_equipment_query = "select store_equip_id, e.name, price_per_unit
                              from store_equipment s, equiment e, store st
                              where store_equip_id = e.equip_id AND
                                    st.store_id = s.equipment_store_id AND
                                    st.store_id = " . Yii::app()->user->store_id . ";";

//get all the warehouse information for the current store
$store_warehouse_query = "select warehouse_id, street_address, zip_code, city, state
                              from warehouse w, store_warehouse s
                              where w.warehouse_id = s.store_warehouse_id AND
                                    s.warehouse_store_id = " . Yii::app()->user->store_id . ";";

//get all the items for the current store
$store_item_query = "select item_id, name, price, sale_price, release_date, quantity
                              from item i, store_item s 
                              where i.item_id = s.store_item_id AND
                                    s.item_store_id = " . Yii::app()->user->store_id . ";";


/* * *************************************************
 * create command objects, execute, and reset query
 * ************************************************* */
//create command objects
$store_item_command = $connection->createCommand($store_item_query);
$store_warehouse_command = $connection->createCommand($store_warehouse_query);
$store_equipment_command = $connection->createCommand($store_equipment_query);

//execute queries
$all_items = $store_item_command->queryAll();
$mywarehouse = $store_warehouse_command->queryRow(); //only want one record
$all_equipment = $store_equipment_command->queryAll();

//clear the query 
$store_item_command->reset();
$store_warehouse_command->reset();
$store_equipment_command->reset();

/* * ***********************************
 * iterations through retrieved data
 * *********************************** */

//iterate through all items to create assoc array
$itemarray = array();

foreach ($all_items as $item) {
    $itemarray[] = array(
        'id' => $item['item_id'],
        'name' => $item['name'],
        'price' => $item['price'],
        'sale_price' => $item['sale_price'],
        'release_date' => $item['release_date'],
        'quantity' => $item['quantity'],
    );
}

//place warehouse info into assoc array
$warehousearray = array(
    'id' => $mywarehouse['warehouse_id'],
    'street_address' => $mywarehouse['street_address'],
    'zip_code' => $mywarehouse['zip_code'],
    'city' => $mywarehouse['city'],
    'state' => $mywarehouse['state'],
);

//iterate through all equipment to create assoc array
$equiparray = array();

foreach ($all_equipment as $equipment) {
    $equiparray[] = array(
        'id' => $equipment['store_equip_id'],
        'name' => $equipment['name'],
        'price_per_unit' => $equipment['price_per_unit'],
    );
}

/* * *******************************************************
 * Data providers -- creates new object from assoc array
 * ******************************************************* */
//
$gridDataProvider_item = new CArrayDataProvider($itemarray);
$gridDataProvider_equipment = new CArrayDataProvider($equiparray);
?>

<h1 class="page-header">Inventory for Store #<?= Yii::app()->user->store_id; ?></h1>

<legend>Store Item Inventory</legend>
<?php
$this->widget('bootstrap.widgets.BsGridView', array(
    'dataProvider' => $gridDataProvider_item
    ,
    'id' => uniqid('table_'),
    'columns' => array(
        array('name' => 'id', 'header' => 'Item #'),
        array('name' => 'name', 'header' => 'Name'),
        array('name' => 'price', 'header' => 'Price'),
        array('name' => 'sale_price', 'header' => 'Sale Price'),
        array('name' => 'release_date', 'header' => 'Release Date'),
        array('name' => 'quantity', 'header' => 'Quantity'),
    ),
    'type' => BSHtml::GRID_TYPE_STRIPED
));
?>
<br/>
<br/>
<legend>Store Warehouse Info</legend>
<div class="row placeholders col-sm-offset-2">
    <div class="col-xs-6 col-sm-2 placeholder">
        <h4>Warehouse #</h4>
        <span class="text-muted"><?= $warehousearray['id']?></span>
    </div>
    <div class="col-xs-6 col-sm-2 placeholder">
        <h4>Address</h4>
        <span class="text-muted"><?= $warehousearray['street_address']?></span>
    </div>
    <div class="col-xs-6 col-sm-2 placeholder">
        <h4>City</h4>
        <span class="text-muted"><?= $warehousearray['city']?></span>
    </div>
    <div class="col-xs-6 col-sm-2 placeholder">
        <h4>State</h4>
        <span class="text-muted"><?= $warehousearray['state']?></span>
    </div>
    <div class="col-xs-6 col-sm-2 placeholder">
        <h4>Zip</h4>
        <span class="text-muted"><?= $warehousearray['zip_code']?></span>
    </div>
</div>
<br/>
<br/>
<legend>Store Equipment</legend>
<?php
$this->widget('bootstrap.widgets.BsGridView', array(
    'dataProvider' => $gridDataProvider_equipment
    ,
    'id' => uniqid('table_'),
    'columns' => array(
        array('name' => 'id', 'header' => 'Equipment #'),
        array('name' => 'name', 'header' => 'Name'),
        array('name' => 'price_per_unit', 'header' => 'Price'),
    ),
    'type' => BSHtml::GRID_TYPE_STRIPED
));
?>
