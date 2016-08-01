<?php
include("Soap_header_token_TachoDataprocesses.php");
include('call_core_orgid.php');
include_once('HighchartsPHP/src/Highchart.php'); 
include_once('HighchartsPHP/src/HighchartJsExpr.php'); 

$StartDateTime='2016-03-17T06:00:00';
$EndDateTime='2016-03-17T07:00:00';
$param_TachoData_range=array("VehicleID"=>921,"Start"=>$StartDateTime ,"End"=>$EndDateTime);
$response_TachoData_range=$TachoDataProcessesWs->__soapCall('GetVehicleCalibratedTachoRange',array($param_TachoData_range));

$chart = new Highchart(Highchart::HIGHSTOCK);
$chart->chart->renderTo = "container";
$chart->rangeSelector->selected = 1;
$chart->title->text = "Example";

//print_r($response_TachoData_range);
$result_TachoData_range=$response_TachoData_range->GetVehicleCalibratedTachoRangeResult->TachoInterval;
//print_r(json_encode($result_TachoData_range));
$chart->series[] = array(
	 'name' => "ruru",
     'data' => new HighchartJsExpr("data"),
     'tooltip' => array(
        'valueDecimals' => 2,
         )
);
$chart->credits->enabled=false;
?>
<html>
    <head>
        <title>Tacografico</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
    </head>
    <body>
        <div id="container" style="height: 400px; min-width: 310px">
        	<script type="text/javascript">
 function (data) {
 	   var data=[];
 	   <?php
         for($i=0;$i<count($result_TachoData_range);$i++){ 
         $result_TachoData_range_Time=$result_TachoData_range[$i]->Time;
        $date_Tacho_Time = new DateTime($result_TachoData_range_Time);
       
         $result_TachoData_range_Speed=$result_TachoData_range[$i]->Speed;
         $result_TachoData_range_RPM=$result_TachoData_range[$i]->RPM;
         	?>
         	 data.push([<?php  echo $date_Tacho_Time->getTimestamp(); ?>,<?php echo $result_TachoData_range_Speed;?>]);
                   
                 <?php } ?>
                
                  return data;
                   window.chart = <?php echo $chart->render(); ?>;

        }      
               
        </script>


</div>
	