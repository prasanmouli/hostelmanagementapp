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

<script type="text/javascript"> 
$(document).ready(function(){	
	$.ajax({
		url : './pages/checkNotifications.php',
		type : 'get' ,
		success : function(data){
	
	if(data!="0"){
	
	alert("Please respond to your notifications first");
	window.location = "notifications.php";
	}
	else{
	 $.ajax({
        url : './pages/checkRoomMateRequest.php' ,
        type : 'get' ,
        success : function(data){
                        
                        if(data==""){
       
                     $('#roomMateSave1').css({"border-color":"#04A4CC" , "background-color": "#04A4CC"});


                                $('#roomMateSave1').empty();    
                                   $('#roomMateSave1').html(" Send Request ");
					document.getElementById('roomMateSave2').style.visibility = "hidden";
				         $('#roomMateSave2').attr('display','none');
                                        $('#roomMateMessage2').empty();
				
	$('#roomMateMessage2').append("Confirm RoomMate 1");
                                }
                        else{
				roomMateRollNo=data.split(";")
					
					if(roomMateRollNo.length==3){	
                                 $('#roomMate1').attr('value' , roomMateRollNo[0]);
				 
		
				   $('#roomMate2').attr('value' , roomMateRollNo[1]);
	                                 

				$('#roomMate1').css({"border" : "1px solid #04A4CC", "color" : "#04A4CC"});
                      $('#roomMateSave1').css({"border-color":"#E66140" , "background-color": "#E66140"});
                     $('#roomMateSave1').html(" Cancel Request ");
		$('#roomMate1').attr('disabled','disabled');

 $('#roomMate2').css({"border" : "1px solid #04A4CC", "color" : "#04A4CC"});
                      $('#roomMateSave2').css({"border-color":"#E66140" , "background-color": "#E66140"});
                      $('#roomMateSave2').html(" Cancel Request ");
                $('#roomMate2').attr('disabled','disabled');
			}
		      else{
			                 $('#roomMate1').attr('value' , roomMateRollNo[0]);					                                $('#roomMate1').css({"border" : "1px solid #04A4CC", "color" : "#04A4CC"});
                      $('#roomMateSave1').css({"border-color":"#E66140" , "background-color": "#E66140"});
                      $('#roomMateSave1').html(" Cancel Request ");
                $('#roomMate1').attr('disabled','disabled');

			

			}
                        }

	       
	},
	complete : function(){
		


//RoomMate 1           

                if($('#roomMateSave1').html()==" Send Request "){
                        
      document.getElementById("roomMateSave2").style.visibility='hidden';
                        $('#roomMateMessage2').empty();
                        $('#roomMateMessage2').append("Confirm RoomMate 1");
                }
                else{
    
                        $.ajax({
                                url : './pages/checkForRoomMate.php' , 
                                type : 'post' ,
                                data : {'roomMateNo' : 1},
                                success : function(data){
        
                                         

                                                       if(data!=""){
                                             
                                                        document.getElementById("roomMateSave2").style.display = 'block';
                                                        document.getElementById("roomMateSave2").style.visibility = "visible";
                                                        $('#roomMateMessage2').empty();
                                                         $('#roomMateSave1').attr("disabled",'disabled');       
                                                        $('#roomMateSave1').html("CONFIRMED");  
                                        
                                                             }
                                                else{
        
                                                        $("#roomMateSave2").attr('display' ,'none');
                                                        document.getElementById("roomMateSave2").style.visibility = "hidden";
                                                  $('#roomMateMessage2').append("RoomMate1 has not confirmed yet.");
                                                }
                                 }
                        });


                        }

               
//RoomMate2
  
                if($('#roomMateSave2').html()!=" Send Request "){
                        
                        $.ajax({
                                url : './pages/checkForRoomMate.php' , 
                                type : 'post' ,
                                data : {'roomMateNo' : 2},
                                success : function(data){
        
                 
                                                       if(data!=""){
        
                                                       
                                                        $('#roomMateMessage2').empty();
                                                        $('#roomMateSave2').attr('disabled', 'disabled');
                                       $('#roomMateSave2').html("CONFIRMED");                                                                                                                 }
                        
                                 }
                        });


                        }
        









		 }
		
        }); 
	}
	}
	});  
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
				if(data=="2"){
				$('#msg').html("Type something into the input field");
				$('#search-result').empty();
				}
				else if(data=="0"){
						$('#msg').html("No Matches Found.");
						$('#search-result').empty();
				}
				else{
        	                var response = data;
			
                	      //  response = response.replace(searchq, "");
                        	document.getElementById('search-result').innerHTML = response;
                                     }   
	                }       
	        });         
               
	},false);
            
//Search Ends  

//Group search starts
                                                                                                                              
	var grpsearchBar = document.getElementById("grp");
        grpsearchBar.addEventListener("keyup",function(){
	    grp =document.getElementById('grp').value;
	    document.getElementById('msg2').style.display = "block";
	    document.getElementById('msg2').innerHTML = "Searching for <strong>"+grp+"</strong>";

	    $.ajax({
	      url : './pages/disproom.php',
		  type : 'get' ,
		  data : {'name' : grp},
		  success : function(data){console.log(data);
		   if(data=="2"){
                                $('#msg2').html("Type something into the input field");
                                $('#grpsearchresult').empty();
                                }
                    else if(data=="0"){
                                      $('#msg2').html("No Matches Found.");
                                       $('#grpsearchresult').empty();
                               }
			else{
			  var response = data;
		//	  response = response.replace(grp, "");
		  	document.getElementById('grpsearchresult').innerHTML = response;
			}
		}
	      });

	  },false);

	//Group Search Ends                      
    var button1 = document.getElementById ("roomMateSave1");
	var button3 = document.getElementById("roomMateSave2");
//	var button4 = document.getElementById("grp1");

        	
	button1.addEventListener ("click", function (){
		var roomMate1 = $('#roomMate1').val();
			  console.log(roomMate1);
                
			  
	    if(($('#roomMateSave1').html() == " Send Request ")){ 
	      if(roomMate1)
		$.ajax({
	          url: "./pages/roomMateRequest.php",
		  type: "POST",
		  data: {'roomMate': roomMate1},
		  success: function(html){
		    if(html!="Invalid"){
			      $('#roomMate1').attr('disabled','disabled');

			
			$('#roomMateMessage2').empty();
		      $('#roomMateMessage1').empty();
                	$('#roomMateMessage1').append("Request Has been sent . Please wait for him/her to accept");
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
		    data: {'roomMate': $('#roomMate1').val(),'roomMateNo' : 1},
		    success: function(){
			
			
		      $('#roomMate1').attr('value', '');
		      $('#roomMateSave1').css({"border-color":"#04A4CC" , "background-color": "#04A4CC"});
		      $('#roomMateSave1').html(" Send Request ");
		      },
			complete : function(){
						$('#roomMate1').removeAttr('disabled');
						$('#roomMateMessage2').empty();
					}
		});
		 button3.style.visibility='hidden';
			 $('#roomMateMessage2').empty();
                        $('#roomMateMessage2').append("Confirm RoomMate 1");
                }
              
	  }, false);

button3.addEventListener("click",function(){
 var roomMate2 = $('#roomMate2').val();
                          
                
                          
            if(($('#roomMateSave2').html() == " Send Request ")){ 
              if(roomMate2){
		
                $.ajax({
                  url: "./pages/roomMateRequest.php",
                  type: "POST",
                  data: {'roomMate': roomMate2},
                  success: function(html){
		
                    if(html!="Invalid"){
                              $('#roomMate2').attr('disabled','disabled');

                       
                        $('#roomMateMessage2').empty();
			 $('#roomMateMessage2').append("Request Has been sent . Please wait for him/her to accept");
                      $('#roomMateMessage1').empty();
                      $('#roomMate2').attr('value', roomMate2);
                      $('#roomMate2').css({"border" : "1px solid #04A4CC", "color" : "#04A4CC"});
                      $('#roomMateSave2').css({"border-color":"#E66140" , "background-color": "#E66140"});
                      $('#roomMateSave2').html("Cancel Request");
                    }
                    else{
                      $('#roomMate2').css({"border" : "2px solid #E66140", "color" : "#E66140"});
                      $('#roomMateMessage2').empty();
                      $('#roomMateMessage2').append("Invalid Roll Number");
                    }
                  }
		
              });
		}
                else{
                             $('#roomMateMessage2').empty();
                      $('#roomMateMessage2').append("Enter Roll Number");
                }
        }
            else{
              $.ajax({
                    url: "./pages/roomMateCancelRequest.php",
                    type: "POST", 
                    data: {'roomMate': $('#roomMate2').val(), 'roomMateNo' : 2},
                    success: function(){
                        
                        
                      $('#roomMate2').attr('value', '');
                      $('#roomMateSave2').css({"border-color":"#04A4CC" , "background-color": "#04A4CC"});
                      $('#roomMateSave2').html(" Send Request ");
                      },
			 complete : function(){
                                                $('#roomMate2').removeAttr('disabled');
                                                $('#roomMateMessage2').empty();
                                        }
                });
                   $('#roomMateMessage2').empty();
                       
                }
              
          }, false);


	/* $.ajax({
        url : './pages/checkRoomMateApproval.php' ,
        type : "GET" ,
        success:function(data){
                if(data!="0"){
                        $('#roomMate1').val(data);
                  $('#roomMateSave1').css({"border-color":"#E66140" , "background-color": "#E66140"});
                      $('#roomMateSave1').html(" Cancel Request ");

                        }
                }
        });*/

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

/*
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

*/


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
<div class="encapsule" style="margin-top: -13px; height: 180px;" align="center" id="roomMate">
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
<img class="loaderImg" style = "display : none;" src="./images/ajax-loader.gif" type="gif" /> 
<div id="floor" class="sortableList">
Registrations for floor or group preference will begin soon!  
</div>
<button id="floorSave" style="display:none;"> SAVE </button>
</div>
</div>
</div>

<div id="searchDiv" align="center">
<h2>Student Search </h2>
<div class="searchInput" align="center">
   <input name="searchq" type="search" id="searchq" size="30"/>
</div>
<div id="msg">Type something into the input field</div>
<div id="search-result"></div>
</div>

</div>

<div id = "groupsearch">
<h2>Group Search</h2>
<div class="searchInput" align="center">
<input name="grp" type="search" id="grp" size="30" />
</div>

<div id="msg2">Type something into the input field</div>

<div id="grpsearchresult"></div>

</div>
</div>

</body>
</html>
