<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"
<?php
     include_once("./pages/config.lib.php");

?>
<html xmlns="http://www.w3.org/1999/xhtml">
</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hostel Management</title>

<link href="./styles/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./scripts/jquery.min.js"></script>
<script type="text/javascript" src="./scripts/jquery-ui.min.js"></script>
<script type="text/javscript">

/* ---------------------------- */
/* XMLHTTPRequest Enable */
/* ---------------------------- */
/*
function createObject() {
var request_type;
var browser = navigator.appName;
if(browser == "Microsoft Internet Explorer"){
request_type = new ActiveXObject("Microsoft.XMLHTTP");
} else {
request_type = new XMLHttpRequest();
}
return request_type;
}
*/
//var http = createObject();

/* -------------------------- */
/* SEARCH */
/* -------------------------- */
/*
function searchNameq() {
searchq = encodeURI(document.getElementById('searchq').value);
document.getElementById('msg').style.display = "block";
document.getElementById('msg').innerHTML = "Searching for <strong>" + searchq+"</strong>";
// Set te random number to add to URL request
nocache = Math.random();
http.open('get', './pages/dbconnection.php?name='+searchq+'');
http.onreadystatechange = searchNameqReply;
http.send(null);
}
function searchNameqReply() {
if(http.readyState == 4){
var response = http.responseText;
//response = response.replace(searchq, "");
document.getElementById('search-result').innerHTML = response;
}
}
*/ 
/*
var searchBar = document.getElementById("searchq");
searchBar.addEventListener("keyup",function(){ 
searchq =document.getElementById('searchq').value;
document.getElementById('msg').style.display = "block";
document.getElementById('msg').innerHTML = "Searching for <strong>" + searchq+"</strong>";
    
$.ajax({
	url : './pages/dbconnection.php',
	type : 'get' , 
	data : {'name' : searchq},
	success : function(data){
			var response = data;
			response = response.replace(searchq, "");
			document.getElementById('search-result').innerHTML = response;
					
		}
	});         
               
},false);
        */    
               
                   
                            
</script>
<script>
  $(function() {
    $( ".sortableList" ).sortable({placeholder: "ui-state-highlight"});
    $( ".sortableList" ).disableSelection();
  });	
</script>
<script type="text/javascript"> 
        $.ajax({
        url : './pages/checkRoomMateRequest.php' ,
        type : 'get' ,
        success : function(data){
                        
                        if(data=="0"){
                        console.log(data);
                      $('#roomMateSave1').css({"background-color": "#04A4CC"});

                                $('#roomMateSave1').empty();    
                                   $('#roomMateSave1').html(" Send Request ");

                                }
                        else{
                                 $('#roomMate1').attr('value' , data);
				 $('#roomMate1').css({"border" : "1px solid #04A4CC", "color" : "#04A4CC"});
                      $('#roomMateSave1').css({"border-color":"#E66140" , "background-color": "#E66140"});
                      $('#roomMateSave1').html("Cancel Request");

					document.getElementById("roomMateSave2").display = "block";
				console.log(document.getElementById("roomMateSave2").display);
				 document.getElementById("roomMateSave2").visibility="visible";
				   console.log(document.getElementById("roomMateSave2").visibility);

                                console.log($('#roomMate1').val());
                        }
                }
        }); 


</script>
<script type="text/javascript">                    

 function AddEventHandler(){
/* 
if(1){	
	$.ajax({
	url : './pages/checkRoomMateRequest.php' ,
	type : 'get' ,
	success : function(data){
			
			if(data=="0"){
			console.log(data);
                      $('#roomMateSave1').css({"background-color": "#04A4CC"});

				$('#roomMateSave1').empty();	
				   $('#roomMateSave1').html(" Send Request ");

				}
			else{
				 $('#roomMate1').attr('value' , data);
				console.log(data);
			}
		}
	}); 
}*/
//SEARCH BAR
	var searchBar = document.getElementById("searchq");
	searchBar.addEventListener("keyup",function(){ 
	searchq =document.getElementById('searchq').value;
	document.getElementById('msg').style.display = "block";
	document.getElementById('msg').innerHTML = "Searching for <strong>"+searchq+"</strong>";
    
	$.ajax({
        	url : './pages/dbconnection.php',
	        type : 'get' , 
        	data : {'name' : searchq},
	        success : function(data){
				if(data==""){
					$('#msg').empty();
				        document.getElementById('msg').innerHTML = "Type something into the input field";

				}
        	                var response = data;
                	        response = response.replace(searchq, "");
                        	document.getElementById('search-result').innerHTML = response;
                                        
	                }       
	        });         
               
	},false);
            
//Search Ends  

    var button1 = document.getElementById ("roomMateSave1");
	var button3 = document.getElementById("roomMateSave2");
	var button4 = document.getElementById("grp1");

        	if($('#roomMateSave1').html()==" Send Request "){
			     button3.style.visibility='hidden';

			$('#roomMateMessage2').append("Confirm RoomMate 1");
		}
		else{
			button3.style.visibility='visible';
			}
		

	button1.addEventListener ("click", function (){
		var roomMate1 = $('#roomMate1').val();
			  console.log(roomMate1);
                
			  
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
                      $('#roomMateSave1').css({"border-color":"#E66140" , "background-color": "#E66140"});
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
		    data: {'roomMate1': $('#roomMate1').val()},
		    success: function(){
			console.log("JHJH");
		      $('#roomMate1').attr('value', '');
		      $('#roomMateSave1').css({"border-color":"#04A4CC" , "background-color": "#04A4CC"});
		      $('#roomMateSave1').html(" Send Request ");
		      }
		});
		 button3.style.visibility='hidden';
			 $('#roomMateMessage2').empty();
                        $('#roomMateMessage2').append("Confirm RoomMate 1");
                }
              
	  }, false);
	 $.ajax({
        url : './pages/checkRoomMateApproval.php' ,
        type : "GET" ,
        success:function(data){
                if(data!="0"){
                        $('#roomMate1').val(data);
                  $('#roomMateSave1').css({"border-color":"#E66140" , "background-color": "#E66140"});
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


	button4.addEventListener ("click", function (){
	    var group1 = $('#grp').val();

              if(group1)
                $.ajax({
                  url: "./pages/disproom.php",
		      type: "POST",
		      data: {'group1': group1},
		      success: function(html){
		      if(html!="Invalid"){
			// button3.style.visibility='visible';
                        $('#groupsearch').append(html);

			$('#grp').attr('value', group1);
			$('#grp1').css({"border" : "1px solid #04A4CC", "color" : "#04A4CC"});
			$('#grp1').css({"border-color":"#E66140" , "background-color": "#E66140"});
		       
		      }
		      else{
			alert('tygvuyhbubu');
			//$('#roomMate1').css({"border" : "2px solid #E66140", "color" : "#E66140"});
			//$('#roomMateMessage1').empty();
			//$('#roomMateMessage1').append("Invalid Roll Number");
		      }
		    }
		  });
	      else{
		$('#roomMateMessage1').empty();
		$('#roomMateMessage1').append("Enter Roll Number");
	      }
	  }, false );




    }
	
</script>

</head>

<body onload="AddEventHandler();" >
<div>
<table id="menuBar">
<tr><td class="menuActive"> Hostel Registration</td> <td> Profile </td> <td> <a href="./notifications.php"> Notifications </a> </td> </tr>
</table>
<h1> Your Preferences </h1>

<div style="float:left;">
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

<div id="searchDiv" align="center">
<h2> Search </h2>
<div class="searchInput" align="center">
   <input name="searchq" type="search" id="searchq" size="30"/>
</div>
<div id="msg">Type something into the input field</div>
<div id="search-result"></div>
</div>

</div>

<div id = "groupsearch">
<input type="text" id = "grp" />
<button id ="grp1"> dfgdf </button>
</div>

</body>
</html>
