
<?php
     $con = mysqli_connect("localhost","root","","c-preciosa");

?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Carl noel Villar">

        <title>Calle Preciousa</title>

    <!-- Bootstrap Core CSS -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="asset/css/landing-page.css" rel="stylesheet">

	   <link href="asset/css/modern-business.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="asset/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="asset/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" href="asset/lib/w3.css">
	<link rel="stylesheet" href="asset/own-asset/style1.css">
	
</head>
    <style>
       .dropdown-a:hover{
        color: black !important;
         }
        
    </style>
  <body>
    <div class="navbar navbar-default navbar-fixed-top" style="background:#421C1E !important;">
      <div class="container" style="width:100%;">
        <div class="navbar-header">
            
            
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a href="" class="navbar-brand"  style="color:white !important;">Calle Preciousa</a>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav navbar-right">
           
            
             <li class="dropdown">
                <a href="#" style="color:white;" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span></a>
                    
                 <style>
                        .dropdown-a:hover{
                            color: black !important;
                        }
                    </style>
                    <ul class="dropdown-menu" id="dropdown1" style="background:#421C1E !important; color:white !important;" >
                        <li><a  class=" dropdown-a" id="register-open" data-toggle="modal" data-target="#myModalLogin" style="cursor:pointer;" ><span class="glyphicon glyphicon-log-in"></span>       Login</a></li>
                        <li><a href="#" class="dropdown-a">Go to Website Page</a></li>
                        
                    </ul>
              </li>
            </ul>
        </div>
          
        
      </div>
    </div>
    <div class="side-nav">
        <div class="list-group">
            <a href="index.php" class="list-group-item "><span class="glyphicon glyphicon-home"></span>    Home</a>
            <a href="calendarManaging.php" class="list-group-item side-nav-active"><span class="glyphicon glyphicon-calendar"></span>     Manage Calendar</a>
            <a href="#" class="list-group-item "><span class="glyphicon glyphicon-tasks"></span>     Reservation</a>
            <a href="addFood.php" class="list-group-item "><span class="glyphicon glyphicon-tasks"></span>     Additional Food</a>
            <a href="pending.php" class="list-group-item "><span class="glyphicon glyphicon-tasks"></span>     Pending Reservation</a>
            <a href="pending.php" class="list-group-item "><span class="glyphicon glyphicon-tasks"></span>     Reserved</a>
        </div>
    </div>
      <div class="body-content">
            <input type="hidden" value="0" id="calendarMove">
            <div class="calendar-div" id="calendar-div">
          
          
            </div>
      
      </div>
      
      
      
      
      
    <a id="loading-open" data-toggle="modal" data-target="#myModalLoading" data-backdrop="static" style="cursor:pointer;display:none;"> ---- </a>
    <div class="modal fade" id="myModalLoading" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
          <button id="loading-close" type="button" class="close" data-dismiss="modal" style="color:white !important;" >&times;</button>
         
        <div class="modal-body" style="padding:40px 50px;">
            
                
              <p>Please wait we're checking your credentials!</p>
            <div class="progress">
              <div class="progress-bar progress-bar-striped active" role="progressbar"
                 style="width:100%;">
                
              </div>
            </div>
        </div>
        
      </div>
      
    </div>
  </div> 
    <a id="modalHoliday-open" data-toggle="modal" data-target="#modalHoliday"  style="cursor:pointer;display:none;"> ---- </a>
    <div class="modal fade" id="modalHoliday" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
          <button id="modalHoliday-close" type="button" class="close" data-dismiss="modal" style="color:white !important;" >&times;</button>
         
        <div class="modal-body" style="padding:40px 50px;">
            
              <p id="errorHolderHolidayModal" style="Display : none;"></p>
              <p id="dateHolderHolidayModal" style="text-align:center;font-size:40px;"></p>
                <input type="hidden" name="inputHolidayModal" id="inputHolidayModal" value="">
                <button class="btn btn-block btn-primary" onclick="setAsHoliday2(document.getElementById('inputHolidayModal').value)">Set As Holiday</button>
        
            
        </div>
        
      </div>
      
    </div>
  </div> 
  
      
   
      <script>
         
          try{
              
              window.onload = loadManagingCalendar(document.getElementById('calendarMove'));
          }catch(err){
              
                    alert(err.message);
                }
          
      function loadManagingCalendar(calendarMove){

                try{
                        
                        document.getElementById('loading-open').click();
                        var move = calendarMove.value;
                       
                   
                        


                      
                            
                           if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }
                       
                            xmlhttp.onreadystatechange = function(){
                                 
                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                        document.getElementById('calendar-div').innerHTML = xmlhttp.responseText;
                                        document.getElementById('loading-close').click();
                                };
                                
                            };

                        if(move != ""){
                            xmlhttp.open("GET","some-function/manageCalendar.php?month="+move,true);
                           
                            xmlhttp.send();
                         }else{
                        
                         xmlhttp.open("GET","some-function/manageCalendar.php",true);
                           
                            xmlhttp.send();
                    }
                }catch(err){
                    alert(err.message);
                    document.getElementById('loading-close').click();
                }
			}
            
          function setAsHoliday(day){
             try{
                 document.getElementById('dateHolderHolidayModal').innerHTML = "DATE : "+day;
             
                document.getElementById('inputHolidayModal').value = day;
                document.getElementById('modalHoliday-open').click();
             }catch(err){
                 alert(err.message);
             }
                
          }
          function setAsHoliday2(day){
               try{
                        
                        document.getElementById('loading-open').click();
                        var x = "Sorry undefine error encounter, please call your developer." 
                       
                           
                        if(day != ""){
                            
                            if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }
                       
                            xmlhttp.onreadystatechange = function(){
                                 
                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                        var result = xmlhttp.responseText;
                                    if(result="success"){
                                        loadManagingCalendar(document.getElementById('calendarMove'));
                                    }else{
                                        var errH =  document.getElementById('errorHolderHolidayModal');
                                        errH.innerHTML = x;
                                        errH.style.display = "block";
                                        document.getElementById('loading-close').click();
                                    }
                                        
                                };
                                
                            };

                            
                            
                            xmlhttp.open("GET","some-function/function.php?setAsHoliday="+day,true);
                           
                            xmlhttp.send();
                         }else{
                        document.getElementById('loading-close').click();
                            
                    }
                }catch(err){
                    alert(err.message);
                    document.getElementById('loading-close').click();
                }
          }
      
      </script>
       <script src="asset/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="asset/js/bootstrap.min.js"></script>
    <script src="asset/f/js1.js"></script>    
  </body>
</html>
