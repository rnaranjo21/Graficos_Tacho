<?php
include("Soap_header_token_TachoDataprocesses.php");
include('call_core_orgid.php');

$StartDateTime='2016-03-15T06:00:00-05:00';
$EndDateTime='2016-03-15T08:00:00-05:00';
$param_TachoData_range=array("VehicleID"=>877,"Start"=>$StartDateTime ,"End"=>$EndDateTime);
$response_TachoData_range=$TachoDataProcessesWs->__soapCall('GetVehicleCalibratedTachoRange',array($param_TachoData_range));
$result_TachoData_range=$response_TachoData_range->GetVehicleCalibratedTachoRangeResult->TachoInterval;

 for($i=0;$i<count($result_TachoData_range);$i++){ 
$result_TachoData_range_Time=$result_TachoData_range[$i]->Time;
$result_TachoData_range_Speed=$result_TachoData_range[$i]->Speed;
$result_TachoData_range_RPM=$result_TachoData_range[$i]->RPM;
$date=strtotime($result_TachoData_range_Time);
$result_TachoData_range_Time1=$result_TachoData_range[++$i]->Time;
$date1=strtotime($result_TachoData_range_Time1);
$result=($date1-$date);

echo Date('l dS \o\f F Y h:i:s ',$date);
print_r("Speed.".$result_TachoData_range_Speed);
print "\t";
print_r("RPM.".$result_TachoData_range_RPM);
 echo '<br>';

echo "Diferencia".$result;
 echo "\t"; echo "\t";
  if($result>1)
  { 	
  	for ($j=0;$j<($result); $j++) { 
 			$fecha=($date+1);
            echo Date('l dS \o\f F Y h:i:s A', $fecha);
            print_r("Speed.".$result_TachoData_range_Speed);
            print "\t";
            print_r("RPM.".$result_TachoData_range_RPM);
            echo '<br>';
            $date=$fecha;  
        }
                     
    }
}          
                        
?>