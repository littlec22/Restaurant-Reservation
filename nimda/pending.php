
<?php
    require_once 'some-function/connect.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Point Of Sale</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      
    <link rel="stylesheet" href="asset/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="asset/css/landing-page.css">
    <link rel="stylesheet" href="asset/css/modern-business.css">
    <link href="asset/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="asset/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    
     <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" href="../lib/w3.css">
    <link rel="stylesheet" href="asset/own-asset/style1.css">
  </head>
    <style>
       .dropdown-a:hover{
        color: black !important;
         }
        
    </style>
  <body>
    <div class="navbar navbar-default navbar-fixed-top" style="background: #421C1E !important;">
      <div class="container" style="width:100%;">
        <div class="navbar-header">
            
            <a class="navbar-brand topnav" href="#"><img style="max-height:200%;margin-top:-10px;" src="asset/img/logo1.png"></a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav navbar-right">
            <li><a href="#" style="color:white;"><span class="glyphicon glyphicon-cog"></span></a></li>
            </ul>
        </div>
          
        
      </div>
    </div>


    <div class="side-nav">
        <div class="list-group">
            <a href="index.php" class="list-group-item "><span class="glyphicon glyphicon-home"></span>    Home</a>
            <a href="calendarManaging.php" class="list-group-item"><span class="glyphicon glyphicon-calendar"></span>     Manage Calendar</a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-tasks"></span>     Reservation</a>
            <a href="addFood.php" class="list-group-item "><span class="glyphicon glyphicon-tasks"></span>     Additional Food</a>
            <a href="pending.php" class="list-group-item side-nav-active"><span class="glyphicon glyphicon-tasks"></span>     Pending Reservation</a>
            <a href="reserved.php" class="list-group-item "><span class="glyphicon glyphicon-tasks"></span>     Reserved</a>
        </div>
    </div>
      
      <div class="body-content container ">
         
          
          
          <div class="row" >
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <h1>List of Pending Reservation</h1>
                        
                    </div>
                </div>
          <hr style="height:30px;border-style: inset;">
          <div id="pendingHolder">
          
          </div>

       </div>
      
     
      
           <!-- Delete AddFood-->
    <a data-toggle="modal" class="btn " style="display:none;" data-target="#viewPendingModal" id="viewPendingModal-open">delete Food</a>
    <div class="modal fade" id="viewPendingModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:25px 50px;background-color:#421C1E;">
          <button id="viewPendingModal-close" type="button" class="close" data-dismiss="modal" style="color:white !important;" >&times;</button>
          <h4 style="color:white !important;"><span class="glyphicon glyphicon-cancel"></span> Pending Reservation</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;max-height:420px;overflow-y:scroll;" >
            
            <table class="table table-condensed" >
                <tbody  id="viewPendingReservationHolder">
                </tbody>
            </table>
          
        </div>
        
      </div>
      
    </div>
  </div>
      <div class="modal fade" id="myModalAccept" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">

                          

                        <div class="modal-body" style="padding:40px 50px;">
                                <button id="accept-close" type="button" class="close" data-dismiss="modal" >&times;</button>
                                <center>
                                    <h1 style="font-size:50px;"><span class="glyphicon glyphicon-envelope"></span></h1>
                                    <p>If you accept this. it will remarks as reserve, but the payment will be remain unpaid.
                                    <br>
                                    <input type="hidden" id="acceptEventId" >
                                    </p>
                                    <br>
                                    <input type="checkbox" value="agree-in-terms-&-condition" onchange="if(this.checked){document.getElementById('accept').style.display = 'block';}else{document.getElementById('accept').style.display = 'none';}"> <label>Yes, i accept it.</label>
                                </center>
                                <a class="btn btn-block btn-primary" style="margin-bottom:10px;  display:none;" id="accept" onclick="acceptEvent();">Accept Event</a>
                                
                        </div>

                      </div>

                    </div>
                  </div> 
      
      <div class="modal fade" id="myModalCancel" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">

                          

                        <div class="modal-body" style="padding:40px 50px;">
                                <button id="cancel-close" type="button" class="close" data-dismiss="modal" style="color:white !important;" >&times;</button>
                                <center>
                                    <h1 style="font-size:50px;"><span class="glyphicon glyphicon-envelope"></span></h1>
                                    <p>If you cancel this event, it will not be asfd,sld.m
                                    <br>
                                    <input type="hidden" id="cancelEventId" >
                                    </p>
                                    <br>
                                    <input type="checkbox" value="agree-in-terms-&-condition" onchange="if(this.checked){document.getElementById('cancel').style.display = 'block';}else{document.getElementById('accept').style.display = 'none';}"> <label>I agree in <a href="#" style="color:red !important;">terms and condition.</a></label>
                                </center>
                                <a class="btn btn-block btn-danger" style="margin-bottom:10px;  display:none;" id="cancel" onclick="cancelEvent();">Cancel Event</a>
                                
                        </div>

                      </div>

                    </div>
                  </div>
      
      <div class="modal fade" id="myModalPayment" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">

                        <div class="modal-header" style="padding:35px 50px;background-color:#421C1E;">
                          <button id="payment-close" type="button" class="close" data-dismiss="modal" style="color:white !important;" >&times;</button>
                          <h4 style="color:white !important;"><span class="glyphicon glyphicon-plus"></span> Payment</h4>
                        </div>   
                        <div class="modal-body" style="padding:40px 50px;">
                               
                                
                                    <div id="payment-contract-amount-div" class="form-group">
                                      <label class="control-label" for="usrname">Contract Amount</label>
                                      <input type="text" class="form-control" id="payment-contract-amount" placeholder="" onchange="document.getElementById('payment-balance').innerHTML = this.value - document.getElementById('payment-amount').value;">
                                         <span id="paymentx1" class="glyphicon glyphicon-remove form-control-feedback" style="visibility:hidden;"></span>
                                    </div>
                                    <div id="payment-amount-div" class="form-group">
                                      <label class="control-label" for="usrname">Payment</label>
                                      <input type="text" class="form-control" id="payment-amount" value="0" onchange="document.getElementById('payment-balance').innerHTML = document.getElementById('payment-contract-amount').value - this.value;">
                                         <span id="paymentx1" class="glyphicon glyphicon-remove form-control-feedback" style="visibility:hidden;"></span>
                                    </div>
                                    <h4>Balance : </h4>
                                    <h4 id="payment-balance">0</h4>
                                    <p>After you submit the payment, it will remarks as reserved.
                                    <input type="hidden" id="paymentEventId" >
                                    </p>
                                    
                                <a class="btn btn-block btn-success" style="margin-bottom:10px;  " id="payment" onclick="paymentEvent();">Submit</a>
                                
                        </div>

                      </div>

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
    <script src="asset/js/jquery.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>
      <script>
          window.onload = pendingLoad();
          
          function pendingLoad(){
             

                try{
                        
                    document.getElementById('loading-open').click();
                      
                           if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }
                       
                            xmlhttp.onreadystatechange = function(){
                                 
                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                        
                                  
                                    var result = xmlhttp.responseText;
                                 
                                    document.getElementById('pendingHolder').innerHTML = result;
                                    document.getElementById('loading-close').click();
                                        
                                    

                                };
                                
                            };


                            xmlhttp.open("GET","some-function/function.php?loadPendingReservation=1",true);
                           
                            xmlhttp.send();


                    
                  
                }catch(err){
                    alert(err.message);
                    document.getElementById('loading-close').click();
                }
			
          }
           function viewPendingReservation(id){
            

                try{
                        
                    document.getElementById('loading-open').click();
                      
                           if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }
                       
                            xmlhttp.onreadystatechange = function(){
                                 
                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                        
                                  
                                    var result = xmlhttp.responseText;
                                 
                                    document.getElementById('viewPendingReservationHolder').innerHTML = result;
                                    document.getElementById('viewPendingModal-open').click();
                                    document.getElementById('loading-close').click();
                                        
                                    

                                };
                                
                            };


                            xmlhttp.open("GET","some-function/function.php?viewEvent="+id,true);
                           
                            xmlhttp.send();


                    
                  
                }catch(err){
                    alert(err.message);
                    document.getElementById('loading-close').click();
                }
			
          }
          function acceptEvent(){
              try{
                  var id=document.getElementById('acceptEventId');
                        
                    document.getElementById('loading-open').click();
                      
                           if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }
                       
                            xmlhttp.onreadystatechange = function(){
                                 
                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                        
                                  
                                    var result = xmlhttp.responseText;
                                    
                                    if(result="success"){
                                        document.getElementById('accept-close').click();
                                        document.getElementById('viewPendingModal-close').click();
                                        pendingLoad();  
                                        document.getElementById('loading-close').click();
                                        
                                         
                                    }else{
                                        document.getElementById('loading-close').click();
                                        alert("undefined error please call your developer.");
                                    }
                                   
                                    
                                    

                                };
                                
                            };


                            xmlhttp.open("GET","some-function/function.php?acceptReservation="+id.value,true);
                           
                            xmlhttp.send();


                    
                  
                }catch(err){
                    alert(err.message);
                    document.getElementById('loading-close').click();
                }
          }
          function cancelEvent(){
              try{
                  var id=document.getElementById('cancelEventId');
                        
                        document.getElementById('loading-open').click();
                      
                           if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }
                       
                            xmlhttp.onreadystatechange = function(){
                                 
                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                        
                                  
                                    var result = xmlhttp.responseText;
                                    
                                    if(result="success"){
                                        document.getElementById('cancel-close').click();
                                        document.getElementById('viewPendingModal-close').click();
                                        pendingLoad();  
                                        document.getElementById('loading-close').click();
                                        
                                         
                                    }else{
                                        document.getElementById('loading-close').click();
                                        alert("undefined error please call your developer.");
                                    }
                                   
                                    
                                    

                                };
                                
                            };


                            xmlhttp.open("GET","some-function/function.php?cancelReservation="+id.value,true);
                           
                            xmlhttp.send();


                    
                  
                }catch(err){
                    alert(err.message);
                    document.getElementById('loading-close').click();
                }
          }
          
          function paymentEvent(){
               
              try{
                var pa = document.getElementById('payment-amount');
                var pca = document.getElementById('payment-contract-amount');
                var id = document.getElementById('paymentEventId');

                var t = pca.value - pa.value;

                if(Number(t).toString() != 'NaN'){
                    if(pa.value == ""){
                        pa.value = "0";
                    }
                    if(pca.value == ""){
                        pca.value = "0";
                    }

                    document.getElementById('loading-open').click();
                      
                           if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }
                       
                            xmlhttp.onreadystatechange = function(){
                                 
                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                        
                                  
                                    var result = xmlhttp.responseText;
                                    
                                    if(result="success"){
                                        document.getElementById('payment-close').click();
                                        document.getElementById('viewPendingModal-close').click();
                                        pendingLoad();  
                                        document.getElementById('loading-close').click();
                                        
                                         
                                    }else{
                                        document.getElementById('loading-close').click();
                                        alert("undefined error please call your developer.");
                                    }
                                   
                                    
                                    

                                };
                                
                            };


                            xmlhttp.open("GET","some-function/function.php?paymentReservationId="+id.value+"&paymentReservationPCA="+pca.value+"&paymentReservationPA="+pa.value,true);
                           
                            xmlhttp.send();    

                  }
              }catch(err){
                    alert(err.message);
                    document.getElementById('loading-close').click();
                }
              
          }
           
      </script>
  </body>
</html>
