<?php
include("client_CoreWs.php");
$Para_login = array("UserName" =>"rnaranjo","Password" =>"rubendario21", "ApplicationID" =>"");
$response_login=$CoreWS->__soapCall('Login', array($Para_login));
$token = $response_login->LoginResult->Token;
$authHeader=array("Token" => $token);
?>