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
  
 function AddEventHandler(){
        var button1 = document.getElementById ("roomMateSave1");
	var button3 = document.getElementById("roomMateSave2");
	$.ajax({
	success : function(){
		button3.style.visibility='hidden';
        	if($('#roomMateSave2').html()==" Send Request "){
			$('#roomMateMessage2').append("Confirm RoomMate 1");
		}
		else{
			button3.style.visibility='visible';
			}
		}

	});
	button1.addEventListener ("click", function (){
		var roomMate1 = $('#roomMate1').val();
                /* 
	        $('#hostel').empty();
		$('.loaderImg').show();
		$.ajax({
    		url: "./pages/hostelList.php",
		success: function(html){
		      $('#hostel').hide();
       		      $('#hostel').append(html);
		      $('#hostel').slideDown();
		      $('#hostelSave').show();
		    },
      		complete: function(){
		      $('.loaderImg').hide();
		    }
		  });
		*/
			  
	    if(($('#roomMateSave1').html() == " Send Request ")){ 
	      if(roomMate1)
		$.ajax({
	          url: "./pages/roomMateRequest.php",
		  type: "POST",
		  data: {'roomMate1': roomMate1},
		  success: function(html){
		    if(html!="Invalid"){
			button3.style.visibility='visible';
			$('#roomMateMessage2').empty();
		      $('#roomMateMessage1').empty();
                      $('#roomMate1').attr('value', roomMate1);
		      $('#roomMate1').css({"border" : "1px solid #04A4CC", "color" : "#04A4CC"});
                      $('#roomMateSave1').css({"background-color": "#E66140"});
                      $('#roomMateSave1').html("Cancel Request");
		    }
                    else{
                      $('#roomMate1').css({"border" : "2px solid #E66140", "color" : "#E66140"});
                      $('#roomMateMessage1').empty();
                      $('#roomMateMessage1').append("Invalid Roll Number");
		    }
		  }
              });
		else{
			     $('#roomMateMessage1').empty();
                      $('#roomMateMessage1').append("Enter Roll Number");
		}
	}
	    else{
	      $.ajax({
		    url: "./pages/roomMateCancelRequest.php",
		    type: "POST", 
		    data: {'roomMate1': roomMate1},
		    success: function(){
		      $('#roomMate1').attr('value', '');
		      $('#roomMateSave1').css({"background-color": "#04A4CC"});
		      $('#roomMateSave1').html(" Send Request ");
		      }
		});
		 button3.style.visibility='hidden';
                        $('#roomMateMessage2').append("Confirm RoomMate 1");
                }
              
	  }, false);
	 $.ajax({
        url : './pageseckRroomMateApproval.php' ,
        type : "GET" ,
        success:function(data){
                if(data!="0"){
                        $('#roomMate1').val(data);
                  $('#roomMateSave1').css({"background-color": "#E66140"});
                      $('#roomMateSave1').html(" Cancel Request ");

                        }
                }
        });

        var button2 = document.getElementById("hostelSave");
        button2.addEventListener("click", function(){
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
         }, false);
    }
	
</script>

</head>

<body onload="AddEventHandler();" >
<div>
<table id="menuBar">
<tr><td class="menuActive"> Hostel Registration</td> <td> Profile </td> <td> Notifications </td> </tr>
</table>
<h1> Your Preferences </h1>

<div class="box"> <h2> ROOM MATES </h2>
<div class="encapsule" style="margin-top: -13px;" align="center" id="roomMate">
<?php
	  include_once("./pages/roomMatePreference.php");
?>
</div>
</div>

<div class="box"> <h2> HOSTEL </h2>
<div class="encapsule" align="center">
<img class="loaderImg" style="display: none;" src="./images/ajax-loader.gif" type="gif" />
<div id="hostel"  class="sortableList">
Registrations for hostels will begin soon!
</div>
<button style="display:none;" id="hostelSave"> SAVE </button>
</div>
</div>

<div class="box"> <h2> FLOOR </h2>
<div class="encapsule" align="center">
<img class="loaderImg" style="display: none;" src="./images/ajax-loader.gif" type="gif" /> 
<div id="floor" class="sortableList">
Registrations for floor or group preference will begin soon!  
</div>
<button id="floorSave" style="display:none;"> SAVE </button>
</div>
</div>

</div>

</body>
</html>
