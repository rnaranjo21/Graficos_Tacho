<?php
$ru=array(1,8,15);
for ($i=0; $i<=count($ru);$i++){ 
		$ru1=$ru[$i];
	  $ru2=$ru[++$i];
       $result=abs($ru1-$ru2);
      echo $ru1;
            echo "\t"; echo "\t";
   echo $result;
       echo '<br>';
     if($result>1){
   	for ($j=0;$j<$result; $j++) { 
 			$fecha=$ru1+1;
            echo  $fecha;
            echo '<br>';
            $ru1=$fecha;  
        }
                         
    }
   
}