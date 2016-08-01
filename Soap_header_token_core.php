<?php
include("client_CoreWs.php");
include("Login.php");
$core = "http://www.omnibridge.com/SDKWebServices/Core";// login , getcurrentorgid ,getfunctionsfor,user,getusercontext,getusercontext no multisearch ,getuserfororganitation,getwebserviceUrls,
//cabecera token en consulta funcion core
$header_core[] = new SoapHeader($core,'TokenHeader',$authHeader, false);
$salida=$CoreWS->__setSoapHeaders($header_core);
?>