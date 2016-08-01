<HTML>
<BODY>
 
<meta charset="utf-8"> 
 
<!-- Latest compiled and minified JavaScript -->
<script src="js/jquery.js"></script>
    <!-- Importo el archivo Javascript de Highcharts directamente desde su servidor -->
<script src="HighStock/js/highstock.js"></script>
<script src="HighStock/js/modules/exporting.js"></script>
<script src="http://highcharts.github.io/export-csv/export-csv.js"></script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>
<script src="http://momentjs.com/downloads/moment-timezone-with-data-2010-2020.min.js"></script>
 <?php
include("Soap_header_token_TachoDataprocesses.php");
include('call_core_orgid.php');

$StartDateTime='2016-04-05T11:00:00-05:00';
$EndDateTime='2016-04-05T12:00:00-05:00';

$param_TachoData_range=array("VehicleID"=>877,"Start"=>$StartDateTime ,"End"=>$EndDateTime);
$response_TachoData_range=$TachoDataProcessesWs->__soapCall('GetVehicleCalibratedTachoRange',array($param_TachoData_range));
$result_TachoData_range=$response_TachoData_range->GetVehicleCalibratedTachoRangeResult->TachoInterval;
//echo '<pre>';
//print_r($response_TachoData_range);
?>
<div id="container">

</div>
 
<script type='text/javascript'>
Highcharts.setOptions({
            global: {
            	  getTimezoneOffset: function (timestamp) {
                var zone = 'America/Bogota',
                    timezoneOffset = -moment.tz(timestamp, zone).utcOffset();

                return timezoneOffset;
            }
               
            }
        });

  $('#container').highcharts('StockChart', {
                        
  chart: {

            zoomType: 'x'
        },
                rangeSelector : {
               buttons : [
               {
                    type : 'hour',
                    count : 0.25,
                    text : '1/4h'
                },{
                    type : 'hour',
                    count : 0.5,
                    text : '1/2h'
               
                }, 
             {
                    type : 'hour',
                    count : 1,
                    text : '1h'
                }, 
                {
                    type : 'day',
                    count : 1,
                    text : '1D'
                }, {
                    type : 'all',
                    count : 1,
                    text : 'All'
                }],
                selected : 1
                  
            },/*
          navigator : {
               enabled:false
            },*/
            title : {
                text : 'Tacográfico'
            },

            legend: {
                enabled: true
            },
            credits:{
            enabled:false
        },

          yAxis: [{ //--- Primary yAxis
           opposite: false,
          title: {
          text: 'Km/h'
                }
           }, { //--- Secondary yAxis
        title: {
        text: 'RPM'
        
          },

         plotLines: [{
                    value: 2500,
                    color: 'green',
                    dashStyle: 'shortdash',
                    width: 3,
                    
                     }]
           
    
}],

                       
        series: [{
                name: 'Speed',
                
                yAxis: 0,
                tooltip : {
                    valueDecimals : 0
                },
                data:(function() {
                     var data = [];
                     <?php
                         for($i=0;$i<count($result_TachoData_range);$i++){ 
                         $result_TachoData_range_Time=$result_TachoData_range[$i]->Time;
                         //$date_Tacho_Time = new DateTime($result_TachoData_range_Time);
                         $result_TachoData_range_Speed=$result_TachoData_range[$i]->Speed;
                         $date=strtotime($result_TachoData_range_Time);
                         $date=strtotime($result_TachoData_range_Time);
                         $result_TachoData_range_Time1=$result_TachoData_range[++$i]->Time;
                         
                         $date1=strtotime($result_TachoData_range_Time1);
                         $result=($date1-$date);
                         ?>
                         data.push([<?php  echo ($date)*1000; ?>,<?php echo $result_TachoData_range_Speed;?>]);
                          <?php
                          if($result>1)
                         {     
                          for ($j=0;$j<($result); $j++) { 
                          $fecha=($date+1);
                          ?>
                          data.push([<?php  echo ($fecha)*1000; ?>,<?php echo $result_TachoData_range_Speed;?>]);
                          <?php
                          $date=$fecha; 
                          }
                          } 
                         ?>

                         
                         <?php } ?>
                return data;
                })()
             },{
                name: 'RPM',
                yAxis: 1,
                
                tooltip : {
                    valueDecimals : 0
                },
                     data: (function() {
                         var data = [];
                    <?php
                     for($i=0;$i<count($result_TachoData_range);$i++){ 
                     $result_TachoData_range_Time=$result_TachoData_range[$i]->Time;
                     //$date_Tacho_Time = new DateTime($result_TachoData_range_Time);
      
                     $result_TachoData_range_RPM=$result_TachoData_range[$i]->RPM;
                    $date=strtotime($result_TachoData_range_Time);
                         $date=strtotime($result_TachoData_range_Time);
                         $result_TachoData_range_Time1=$result_TachoData_range[++$i]->Time;
                         
                         $date1=strtotime($result_TachoData_range_Time1);
                         $result=($date1-$date);
                         ?>
                         data.push([<?php  echo ($date)*1000; ?>,<?php echo $result_TachoData_range_RPM;?>]);
                          <?php
                          if($result>1)
                         {     
                          for ($j=0;$j<($result); $j++) { 
                          $fecha=($date+1);
                          ?>
                          data.push([<?php  echo ($fecha)*1000; ?>,<?php echo $result_TachoData_range_RPM;?>]);
                          <?php
                          $date=$fecha; 
                          }
                          } 
                         ?>
                    <?php } ?>
                return data;
                     })()                
                    
          }]
    
  });       

             
</script>
