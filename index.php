<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	include_once("./pages/config.lib.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hostel Management</title>

<link href="./styles/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./scripts/jquery.min.js"></script>
<script type="text/javascript" src="./scripts/jquery-ui.min.js"></script>

<script>
  $(function() {
    $( ".sortableList" ).sortable({placeholder: "ui-state-highlight"});
    $( ".sortableList" ).disableSelection();
  });	
</script>

<script type="text/javascript">

   
	/*// show loading image
	$('#loaderImg').show();
	// main image loaded?
	$('#floor').load(function(){
  	// hide/remove the loading image
  	$('#loaderImg').hide();
	$('#floor').empty();
	});*/
	

	function hostelSave(){
		$('#roomMate').empty();
		$('.loaderImg').show();
		$.ajax({
    		url: "./pages/roomMatePreference.php",
			success: function(html){
				$('#roomMate').hide();
        		$('#roomMate').append(html);
				$('#roomMate').slideDown();
      		},
      		complete: function(){
        		$('.loaderImg').hide();
      		}
    	});
	}
	
	function groupSave(){
		$('#floor').empty();
		$('.loaderImg').show();
		$.ajax({
			url: "./pages/displayFloors.php",
      		success: function(html){
				$('#floor').hide();
        		$('#floor').append(html);
				$('#floor').slideDown();
				$('#floorSave').show();
      		},
      		complete: function(){
        		$('.loaderImg').hide();
      		}
    	});
	}
	
</script>

</head>

<body>
<div>
<table id="menuBar">
<tr><td class="menuActive"> Hostel Registrtaion</td> <td> Profile </td> <td> Notifications </td> </tr>
</table>
<h1> Your Preferences </h1>

<div class="box"> <h2> HOSTEL </h2>
<div class="encapsule" align="center">
<div class="sortableList">
<?php
	include_once("./pages/hostelList.php");
?>
</div>
<button id="hostelSave" onclick="hostelSave()"> SAVE </button>
</div>
</div>

<div class="box"> <h2> ROOM MATES </h2>
<div class="encapsule" style="margin-top: -13px;" align="center">
<img class="loaderImg" style="display: none;" src="./images/ajax-loader.gif" type="gif" /> 
<div id="roomMate" class="sortableList">
Confirm floor prefernce! 
</div>
</div>

<div class="box"> <h2> FLOOR </h2>
<div class="encapsule" align="center">
<img class="loaderImg" style="display: none;" src="./images/ajax-loader.gif" type="gif" /> 
<div id="floor" class="sortableList">
Confirm hostel prefernce! 
</div>
<button id="floorSave" style="display:none;"> SAVE </button>
</div>
</div>

</div>

</body>
</html>