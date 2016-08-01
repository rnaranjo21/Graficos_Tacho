<?php
/*En este Sript Definimos el Id de la Organizacion Para consultar* y la peticion de en la que esta actulamente seleccionda*/

include("Soap_header_token_core.php");//include("Call_Core.php")//include cuando se quiera adicionar el Id de algunana organizacion para navegar en ella
//parametro para seleccionar con id de la organizacion 
try {
$paramsStorg= array("NewOrganisationID" => 626);
$result= $CoreWS->__soapCall('SetCurrentOrgID', array($paramsStorg));
} catch (SoapFault $fault) {
    trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
}
//parametros para pedir la organizacion geleccionada actualmente
/*
$paramsGEtorgId=array("TokenHeader");
$response_getOrgID=$CoreWS->__soapCall('GetCurrentOrgID', array($paramsGEtorgId));
$getOrgID=$response_getOrgID->GetCurrentOrgIDResult;
print_r($getOrgID);
*/
?>