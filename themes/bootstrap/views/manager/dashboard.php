<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
      
          <h1 class="page-header">Dashboard</h1>
          <?php
$this->pageTitle=Yii::app()->name . ' - '.Yii::t('app','Highcharts');
?>
 
<?php
 
$level1 = array();
$level1[] = array('name' => 'GroupOne', 'y' => 11, 'drilldown' => 'dd1');
$level1[] = array('name' => 'GroupTwo', 'y' => 22, 'drilldown' => 'dd2');
$level1[] = array('name' => 'GroupThree', 'y' => 33, 'drilldown' => 'dd3');
 
$level2 = array();
$level2[] = array('id' => 'dd1', 'data' => array(array('Detail1', 1), array('Detail2', 2), array('Detail3', 4)));
$level2[] = array('id' => 'dd2', 'data' => array(array('Detaila', 8), array('Detailb', 9), array('Detailc', 3)));
$level2[] = array('id' => 'dd3', 'data' => array(array('DetailX', 7), array('DetailY', 5), array('DetailZ', 6)));
 
$this->Widget('ext.graph.highcharts.HighchartsWidget', array(
        'scripts' => array(
        'modules/drilldown', // in fact, this is mandatory :)
        ),
    'options'=>array(
        'chart' => array('type' => 'column'),
        'title' => array('text' => Yii::t('app','Levels 1 and 2')),
        'subtitle' => array('text' => Yii::t('app','Click the columns to view details.')),
        'xAxis' => array('type' => 'category'),
        'yAxis' => array('title' => array('text' => Yii::t('app','Vertical legend')),),
        'legend' => array('enabled' => false),
        'plotOptions' => array (
            'series' => array (
                            'borderWidth' => 0,
                            'dataLabels' => array(
                                'enabled' => true,
                            ),
                        ),
                    ),
        'series' => array (array(
                        'name' => 'MyData',
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
              
            <div class="col-xs-6 col-sm-3 placeholder">
              <img data-src="holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img data-src="holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img data-src="holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img data-src="holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
          </div>

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