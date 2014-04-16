<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
$connection = Yii::app()->db;
//get all order deatils for the specific customer
$user_orderhistory_query = "select sale_cust_id, sale_item_id, sale_store_id,item_id
                              where store_equip_id = e.equip_id AND
                                    st.store_id = s.equipment_store_id AND
                                    st.store_id = " . Yii::app()->user->sale_cust_id . ";";


