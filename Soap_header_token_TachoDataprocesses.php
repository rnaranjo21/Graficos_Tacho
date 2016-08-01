<?php
include("client_TachoDataProcessesWS.php");
include("call_core.php");
$core = "http://www.omnibridge.com/SDKWebServices/AssetData";// login , getcurrentorgid ,getfunctionsfor,user,getusercontext,getusercontext no multisearch ,getuserfororganitation,getwebserviceUrls,
//cabecera token en consulta funcion core
$header_core[] = new SoapHeader($core,'TokenHeader',$authHeader, false);
$salida=$TachoDataProcessesWs->__setSoapHeaders($header_core);