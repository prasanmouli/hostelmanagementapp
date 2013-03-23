<?php
   include_once("./pages/config.lib.php"); 

	$list = array();
	$nameList = array();
	$i=0; $j=0;
        $stringList="";	

	$query = "SELECT * FROM userPreferences";
	$res = mysql_query($query);
	while($info = mysql_fetch_array($res)){
		if($info['userId'] == $_SESSION['userId'])
			$yearOfStudy = $info['year'];
	}
	
	$query = "SELECT * FROM hostelDetails ORDER BY hostelId";
	$res = mysql_query($query);
	while($info = mysql_fetch_array($res)){
		if($info['hostelYear'] == 2)	
			if(!in_array($info['hostelId'], $list))
				$list[$i++] = $info['hostelId'];
		}
		
	$query = "SELECT * FROM hostels";
	$res = mysql_query($query);
	while($info = mysql_fetch_array($res)){
		if($info['hostelId'] == $list[$j]){
			$nameList[$j] = $info['hostelName'];
			$j++;
			}
	}
	
	$stringList .="";
	for($j=0; $j<count($nameList); $j++)
		$stringList .= "<ul class='ui-state-default'> <li>".$nameList[$j]."</li> </ul> ";
	$stringList .="";
		
	echo $stringList;
?>