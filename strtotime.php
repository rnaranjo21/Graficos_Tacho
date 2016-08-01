
<?php
include("Soap_header_token_TachoDataprocesses.php");
include('call_core_orgid.php');

$StartDateTime='2016-03-31T06:00:00-05:00';
$EndDateTime='2016-03-31T07:30:00-05:00';

$param_TachoData_range=array("VehicleID"=>877,"Start"=>$StartDateTime ,"End"=>$EndDateTime);
$response_TachoData_range=$TachoDataProcessesWs->__soapCall('GetVehicleCalibratedTachoRange',array($param_TachoData_range));
$result_TachoData_range=$response_TachoData_range->GetVehicleCalibratedTachoRangeResult->TachoInterval;
 for($i=0;$i<count($result_TachoData_range);$i++){ 
$result_TachoData_range_Time=$result_TachoData_range[$i]->Time;
$date_Tacho_Time = new DateTime($result_TachoData_range_Time);
$result_TachoData_range_Speed=$result_TachoData_range[$i]->Speed;
$result_TachoData_range_RPM=$result_TachoData_range[$i]->RPM;
print_r("Time.".$date_Tacho_Time->format('d/m/Y (H:i:s)'));
print "\t";
print_r("Speed.".$result_TachoData_range_Speed);
print "\t";
print_r("RPM.".$result_TachoData_range_RPM);
print "\t";
echo '<br>';
}

?>