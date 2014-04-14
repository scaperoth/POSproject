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
<div class="row placeholders">

    <h2 class="sub-header">Section title</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Header</th>
                    <th>Header</th>
                    <th>Header</th>
                    <th>Header</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1,001</td>
                    <td>Lorem</td>
                    <td>ipsum</td>
                    <td>dolor</td>
                    <td>sit</td>
                </tr>
                <tr>
                    <td>1,002</td>
                    <td>amet</td>
                    <td>consectetur</td>
                    <td>adipiscing</td>
                    <td>elit</td>
                </tr>
                <tr>
                    <td>1,003</td>
                    <td>Integer</td>
                    <td>nec</td>
                    <td>odio</td>
                    <td>Praesent</td>
                </tr>
                <tr>
                    <td>1,003</td>
                    <td>libero</td>
                    <td>Sed</td>
                    <td>cursus</td>
                    <td>ante</td>
                </tr>
                <tr>
                    <td>1,004</td>
                    <td>dapibus</td>
                    <td>diam</td>
                    <td>Sed</td>
                    <td>nisi</td>
                </tr>
                <tr>
                    <td>1,005</td>
                    <td>Nulla</td>
                    <td>quis</td>
                    <td>sem</td>
                    <td>at</td>
                </tr>
                <tr>
                    <td>1,006</td>
                    <td>nibh</td>
                    <td>elementum</td>
                    <td>imperdiet</td>
                    <td>Duis</td>
                </tr>
                <tr>
                    <td>1,007</td>
                    <td>sagittis</td>
                    <td>ipsum</td>
                    <td>Praesent</td>
                    <td>mauris</td>
                </tr>
                <tr>
                    <td>1,008</td>
                    <td>Fusce</td>
                    <td>nec</td>
                    <td>tellus</td>
                    <td>sed</td>
                </tr>
                <tr>
                    <td>1,009</td>
                    <td>augue</td>
                    <td>semper</td>
                    <td>porta</td>
                    <td>Mauris</td>
                </tr>
                <tr>
                    <td>1,010</td>
                    <td>massa</td>
                    <td>Vestibulum</td>
                    <td>lacinia</td>
                    <td>arcu</td>
                </tr>
                <tr>
                    <td>1,011</td>
                    <td>eget</td>
                    <td>nulla</td>
                    <td>Class</td>
                    <td>aptent</td>
                </tr>
                <tr>
                    <td>1,012</td>
                    <td>taciti</td>
                    <td>sociosqu</td>
                    <td>ad</td>
                    <td>litora</td>
                </tr>
                <tr>
                    <td>1,013</td>
                    <td>torquent</td>
                    <td>per</td>
                    <td>conubia</td>
                    <td>nostra</td>
                </tr>
                <tr>
                    <td>1,014</td>
                    <td>per</td>
                    <td>inceptos</td>
                    <td>himenaeos</td>
                    <td>Curabitur</td>
                </tr>
                <tr>
                    <td>1,015</td>
                    <td>sodales</td>
                    <td>ligula</td>
                    <td>in</td>
                    <td>libero</td>
                </tr>
            </tbody>
        </table>
    </div>