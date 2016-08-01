<?php
$ru=array("2016-03-31T06:00:00","2016-03-31T06:01:00","2016-03-31T06:02:00");
for ($i=0; $i<count($ru);$i++){ 
		$ru1=$ru[$i];
		$date=strtotime($ru1);
        $ru2=$ru[$i+1];
        $date1=strtotime($ru2);
        $result=($date1-$date);
      echo $result;
      echo "\t"; echo "\t";
      echo Date('l dS \o\f F Y h:i:s A',$date);
       echo '<br>';
     if($result>1)
  { 	for ($j=0;$j<$result; $j++) { 
 			$fecha=($date+1);
            echo Date('l dS \o\f F Y h:i:s A', $fecha);
            echo '<br>';
           $date=$fecha;  
        }
                         
    }
  
  
}

?>