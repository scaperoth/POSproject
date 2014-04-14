<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<h1 class="page-header">Dashboard</h1>
<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Highcharts');
?>
<legend>Top Stores</legend>
<?php
$connection = Yii::app()->db;

//query to get all sale numbers grouped by store id
$total_sales_by_store_query = "
    SELECT sale_store_id, st.city, st.state, SUM(price) total_sales 
FROM sale s, item i, store st
WHERE st.store_id = sale_store_id AND
      i.item_id = s.sale_item_id
group by s.sale_store_id;
";

//query to get all sale numbers grouped by employee at specific store
$total_sales_by_employee_at_store_query = "
SELECT user_id, f_name, l_name, sale_store_id, SUM(price) total_sales 
FROM user u, employee e, sale s, item i
WHERE s.sale_store_id = :store_id AND
      u.user_id = e.emp_id AND
      e.emp_id = s.sale_emp_id AND
      i.item_id = s.sale_item_id 
group by u.user_id;
";

//prepare the queries
$sales_by_store_command = $connection->createCommand($total_sales_by_store_query);
$sales_by_employees_command = $connection->createCommand($total_sales_by_employee_at_store_query);

//execute the first query
$dataReader = $sales_by_store_command->queryAll();
$sales_by_store_command->reset();
$level1 = array();
$level2 = array();
$i = 1;

//loop through all stores found in first query
foreach ($dataReader as $row) {
    $level1[] = array('name' => $row['city'] . ", " . $row['state'], 'y' => intval($row['total_sales']), 'drilldown' => "dd$i");

    //reinitialize sale data
    $sale_data = array();

    //assign parameters and execute second query
    $sales_by_employees_command->bindParam(":store_id", doubleval($row['sale_store_id']), PDO::PARAM_STR);
    $sales_by_employees = $sales_by_employees_command->queryAll();

    //loop through each employee at current store and put data into array for highcharts drilldown
    foreach ($sales_by_employees as $sale) {
        $sale_data[] = array($sale['f_name'] . ' ' . $sale['l_name'], doubleval($sale['total_sales']));
    }

    //add employee sales data to drilldown array
    $level2[] = array('id' => "dd$i", 'data' => $sale_data);

    $i++;
}
$sales_by_employees_command->reset();

$this->Widget('ext.graph.highcharts.HighchartsWidget', array(
    'scripts' => array(
        'modules/drilldown', // in fact, this is mandatory :)
    ),
    'options' => array(
        'chart' => array('type' => 'column'),
        'title' => array('text' => Yii::t('app', 'Store Sales')),
        'subtitle' => array('text' => Yii::t('app', 'Click the columns to view details.')),
        'xAxis' => array('type' => 'category'),
        'yAxis' => array('title' => array('text' => Yii::t('app', 'Sales')),),
        'legend' => array('enabled' => false),
        'plotOptions' => array(
            'series' => array(
                'borderWidth' => 0,
                'dataLabels' => array(
                    'enabled' => true,
                ),
            ),
        ),
        'series' => array(array(
                'name' => "Total Sales",
                'colorByPoint' => true,
                'data' => $level1,
            )),
        'drilldown' => array(
            'series' => $level2,
        ),
    ),
));
?>
<br/>
<legend>Top Employee Sales</legend>
<?php
//query to get all sale numbers grouped by employee at specific store
$total_sales_by_all_employees_query = "
SELECT user_id, f_name, l_name, sale_store_id, SUM(price) total_sales 
FROM user u, employee e, sale s, item i
WHERE u.user_id = e.emp_id AND
      e.emp_id = s.sale_emp_id AND
      i.item_id = s.sale_item_id 
group by u.user_id
order by total_sales desc;
";

$sales_by_all_employees_command = $connection->createCommand($total_sales_by_all_employees_query);


//execute the third query
$all_sales = $sales_by_all_employees_command->queryAll();
$sales_by_all_employees_command->reset();

$dataarray = array();

foreach ($all_sales as $emp_sales) {
    $dataarray[] = array(
        'id' => $emp_sales['user_id'], 
        'firstName' => $emp_sales['f_name'], 
        'lastName' => $emp_sales['l_name'],
        'sale_store_id' => $emp_sales['sale_store_id'],
        'total_sales' => $emp_sales['total_sales']
    );
}

$gridDataProvider = new CArrayDataProvider($dataarray);

$this->widget('bootstrap.widgets.BsGridView', array(
    'dataProvider' => $gridDataProvider
    ,
    'id' => uniqid('table_'),
    'columns' => array(
        array('name'=>'id', 'header'=>'#'),
        array('name'=>'firstName', 'header'=>'First name'),
        array('name'=>'lastName', 'header'=>'Last name'),
        array('name'=>'sale_store_id', 'header'=>'Store ID'),
        array('name'=>'total_sales', 'header'=>'Total Sales'),

    ),
    'type' => BsHtml::GRID_TYPE_HOVER
));
?>