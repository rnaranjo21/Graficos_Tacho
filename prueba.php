<HTML>
<BODY>
 
<meta charset="utf-8"> 
 
<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery.js"></script>
    <!-- Importo el archivo Javascript de Highcharts directamente desde su servidor -->
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
 <?php
include("Soap_header_token_TachoDataprocesses.php");
include('call_core_orgid.php');
include_once('HighchartsPHP/src/Highchart.php'); 
include_once('HighchartsPHP/src/HighchartJsExpr.php'); 

$StartDateTime='2016-03-17T09:00:00-05:00';
$EndDateTime='2016-03-17T10:00:00-05:00';
$param_TachoData_range=array("VehicleID"=>921,"Start"=>$StartDateTime ,"End"=>$EndDateTime);
$response_TachoData_range=$TachoDataProcessesWs->__soapCall('GetVehicleCalibratedTachoRange',array($param_TachoData_range));
$result_TachoData_range=$response_TachoData_range->GetVehicleCalibratedTachoRangeResult->TachoInterval;
?>
<div id="container">
</div>
 
 
<script type='text/javascript'>
$(function () {
    $(document).ready(function() {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });
    
        var chart;
        $('#container').highcharts({
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                zoomType: 'x',
                events: {
                    load: function() {
                        
                    }
                }
                
            },

            title: {
                text: 'Tacografico'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Valor'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
                        Highcharts.numberFormat(this.y, 2);
                }
            },

            legend: {
                enabled: true
            },
            exporting: {
                enabled: true
            },
            credits:{
                enabled:false
            },
            series: [{
                name: 'Speed',
                data: (function() {
                   var data = [];
                    <?php
                         for($i=0;$i<count($result_TachoData_range);$i++){ 
         $result_TachoData_range_Time=$result_TachoData_range[$i]->Time;
        $date_Tacho_Time = new DateTime($result_TachoData_range_Time);
      
         $result_TachoData_range_Speed=$result_TachoData_range[$i]->Speed;
        
                    ?>
                     data.push([<?php  echo $date_Tacho_Time->getTimestamp()*1000; ?>,<?php echo $result_TachoData_range_Speed;?>]);
                    <?php } ?>
                return data;
                })()
             },{
                name: 'RPM',
                     data: (function() {
                         var data = [];
                    <?php
            for($i=0;$i<count($result_TachoData_range);$i++){ 
         $result_TachoData_range_Time=$result_TachoData_range[$i]->Time;
        $date_Tacho_Time = new DateTime($result_TachoData_range_Time);
         $result_TachoData_range_RPM=$result_TachoData_range[$i]->RPM;
                    ?>
                    data.push([<?php echo $date_Tacho_Time->getTimestamp()*1000;?>,<?php echo $result_TachoData_range_RPM; ?>]);
                    <?php } ?>
                return data;
                     })()                
                    
          }]
     });
  });       
});
 
 
</script>
</html>

  

