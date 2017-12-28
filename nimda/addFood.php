
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
            <a href="addFood.php" class="list-group-item side-nav-active"><span class="glyphicon glyphicon-tasks"></span>     Additional Food</a>
            <a href="pending.php" class="list-group-item "><span class="glyphicon glyphicon-tasks"></span>     Pending Reservation</a>
            <a href="reserved.php" class="list-group-item "><span class="glyphicon glyphicon-tasks"></span>     Reserved</a>
        </div>
    </div>
      
      <div class="body-content container ">
          <h1 style="float:left;">Additional Food</h1>
          <a data-toggle="modal" class="btn " style="background:#421C1E !important; color:white !important; width:250px !important; margin:13px 0 0 10px" data-target="#myAddFood" style="cursor:pointer;"><span class="glyphicon glyphicon-plus"></span >    Add Food</a>
          
          <hr style="height:30px;border-style: inset;">
          <div class="row" >
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <h1>List of Additional Food</h1>
                        
                    </div>
                </div>
                <div class="row">
                    <!-- progress report -->
                    <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-striped">
                            <thead >
                              <tr >
                                <th style="font-weight:900 !important; width:50%;">Food name</th>
                                <th style="font-weight:900 !important;width:30%;">Price</th>
                                <th style="font-weight:900 !important;width:20%;">Action</th>
                              </tr>
                            </thead>
                            <tbody id="addFoodTbody">
                                 
                                <tr>
                                    <th>A</th>
                                    <th>A</th>
                                    <th>A</th>
                                </tr>
                                
                            </tbody>
                          </table>
                    </div>
            
      
                </div>
       </div>
      
     <div class="modal fade" id="myAddFood" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;background-color:#421C1E;">
          <button id="addFood-close" type="button" class="close" data-dismiss="modal" style="color:white !important;" >&times;</button>
          <h4 style="color:white !important;"><span class="glyphicon glyphicon-plus"></span> Add Food</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form">
              
            <div id="nf-div" class="form-group">
              <label class="control-label" for="usrname">Name of the Food (please dont use dash ( - ) )</label>
              <input type="text" class="form-control" id="nf" placeholder="">
                 <span id="addFoodx1" class="glyphicon glyphicon-remove form-control-feedback" style="visibility:hidden;"></span>
            </div>
            <div id="pf-div" class="form-group ">
                <label class="control-label" for="psw">Price (use on number and period (.) )</label>
                <input type="text" class="form-control" id="pf" placeholder="">
                <span id="addFoodx2" class="glyphicon glyphicon-remove form-control-feedback"  style="visibility:hidden;"></span>
            </div>
            
              <button type="button" class="btn btn-success btn-block" style="background-color:#421C1E;" onclick="try{addFood();}catch(err){alert(err.message);}"><span class="glyphicon glyphicon-plus"></span>  ADD</button>
              <button type="button" class="btn btn-danger btn-block" data-dismiss="modal" > Cancel</button>
               <center>
                 
              </center>
          </form>
        </div>
        
      </div>
      
    </div>
  </div>  
      <!--edit Food-->
      <a data-toggle="modal" class="btn " style="display:none;" data-target="#myEditFood" id="editFood-open">Edit Food</a>
       <div class="modal fade" id="myEditFood" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;background-color:#421C1E;">
          <button id="editFood-close" type="button" class="close" data-dismiss="modal" style="color:white !important;" >&times;</button>
          <h4 style="color:white !important;"><span class="glyphicon glyphicon-plus"></span> Edit Food</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form">
              
            <div id="edit-nf-div" class="form-group">
              <label class="control-label" for="usrname">Name of the Food (please dont use dash ( - ) )</label>
              <input type="text" class="form-control" id="edit-nf" placeholder="">
                 <span id="editFoodx1" class="glyphicon glyphicon-remove form-control-feedback" style="visibility:hidden;"></span>
            </div>
            <div id="edit-pf-div" class="form-group ">
                <label class="control-label" for="psw">Price (use on number and period (.) )</label>
                <input type="text" class="form-control" id="edit-pf" placeholder="">
                <input type="hidden" class="form-control" id="edit-id" placeholder="">
                <span id="editFoodx2" class="glyphicon glyphicon-remove form-control-feedback"  style="visibility:hidden;"></span>
            </div>
            
              <button type="button" class="btn btn-success btn-block" style="background-color:#421C1E;" onclick="try{editAddFood2();}catch(err){alert(err.message);}"><span class="glyphicon glyphicon-plus"></span> Save</button>
              <button type="button" class="btn btn-danger btn-block" data-dismiss="modal" > Cancel</button>
               <center>
                 
              </center>
          </form>
        </div>
        
      </div>
      
    </div>
      </div>     
           <!-- Delete AddFood-->
        <a data-toggle="modal" class="btn " style="display:none;" data-target="#myDeleteFood" id="deleteFood-open">delete Food</a>
    <div class="modal fade" id="myDeleteFood" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;background-color:#421C1E;">
          <button id="deleteFood-close" type="button" class="close" data-dismiss="modal" style="color:white !important;" >&times;</button>
          <h4 style="color:white !important;"><span class="glyphicon glyphicon-cancel"></span> Delete Food</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
         
              
                <h5 id="delete-Phrase"></h5>
                <input type="hidden" class="form-control" id="delete-id" placeholder="">
                <br>
                <br>
            
              <button type="button" class="btn btn-success btn-block" style="background-color:#421C1E;" onclick="try{deleteAddFood2();}catch(err){alert(err.message);}"><span class="glyphicon glyphicon-plus"></span> Delete</button>
              <button type="button" class="btn btn-danger btn-block" data-dismiss="modal" > Cancel</button>
               <center>
                 
              </center>
          
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
          
            window.onload =  loadAddFood();
      
            function addFood(){

                try{
                        
                    document.getElementById('loading-open').click();
                       var nf = document.getElementById('nf');
                        var pf = document.getElementById('pf');
                   
                        var str = nf.value;
                        var patt1 = /-/g;
                        var resultnf = str.match(patt1);

                         var pf1 = Number(pf.value);
                   
                    
                        
                    
                    
                        if((resultnf==null)&&(pf1.toString() !=  'NaN')){
                            
                           if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }
                       
                            xmlhttp.onreadystatechange = function(){
                                 
                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                        
                                  
                                    var result = xmlhttp.responseText;
                                    if(result == "success"){
                                       loadAddFood();
                                        document.getElementById('loading-close').click();
                                        document.getElementById('addFood-close').click();
                                        
                                    }else{
                                            document.getElementById('loading-close').click();
                                            var nf_div = document.getElementById('nf-div');
                                            var pf_div = document.getElementById('pf-div');
                                            nf_div.classList.toggle("has-error")
                                            nf_div.classList.toggle("has-feedback")
                                            pf_div.classList.toggle("has-error")
                                            pf_div.classList.toggle("has-feedback")

                                            document.getElementById('addFoodx1').style.visibility = "visible";
                                            document.getElementById('addFoodx2').style.visibility = "visible";
                                            
                                    }

                                };
                                
                            };


                            xmlhttp.open("GET","some-function/function.php?addFoodName="+nf.value+"&addFoodPrice="+pf.value,true);
                           
                            xmlhttp.send();


                    
                    }else{
                       
                        var nf_div = document.getElementById('nf-div');
                        var pf_div = document.getElementById('pf-div');
                        if(resultnf!=null){
                            nf_div.classList.toggle("has-error");
                            nf_div.classList.toggle("has-feedback");
                            document.getElementById('addFoodx1').style.visibility = "visible";
                        }
                        if(pf1.toString() ==  'NaN'){
                            pf_div.classList.toggle("has-error");
                            pf_div.classList.toggle("has-feedback");
                            document.getElementById('addFoodx2').style.visibility = "visible";
                        }
                        
                        
                        
                        document.getElementById('loading-close').click();
                    }
                }catch(err){
                    alert(err.message);
                    document.getElementById('loading-close').click();
                }
			}
          function loadAddFood(){

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
                                 
                                    document.getElementById('addFoodTbody').innerHTML = result;
                                    document.getElementById('loading-close').click();
                                        
                                    

                                };
                                
                            };


                            xmlhttp.open("GET","some-function/function.php?loadAddFood=1",true);
                           
                            xmlhttp.send();


                    
                  
                }catch(err){
                    alert(err.message);
                    document.getElementById('loading-close').click();
                }
			}
        function editAddFood( name, price, id){
            document.getElementById('edit-nf').value = name;
            document.getElementById('edit-pf').value = price;
            document.getElementById('edit-id').value = id;
            document.getElementById('editFood-open').click();
        }
          function editAddFood2(){

                try{
                        
                    document.getElementById('loading-open').click();
                       var nf = document.getElementById('edit-nf');
                        var pf = document.getElementById('edit-pf');
                        var id = document.getElementById('edit-id');
                   
                        var str = nf.value;
                        var patt1 = /-/g;
                        var resultnf = str.match(patt1);

                         var pf1 = Number(pf.value);
                   
                    
                        
                    
                    
                        if((resultnf==null)&&(pf1.toString() !=  'NaN')){
                            
                           if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }
                       
                            xmlhttp.onreadystatechange = function(){
                                 
                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                        
                                  
                                    var result = xmlhttp.responseText;
                                    if(result == "success"){
                                       
                                        loadAddFood();
                                        document.getElementById('loading-close').click();
                                        document.getElementById('editFood-close').click();
                                        
                                    }else{
                                            document.getElementById('loading-close').click();
                                            var nf_div = document.getElementById('edit-nf-div');
                                            var pf_div = document.getElementById('edit-pf-div');
                                            nf_div.classList.toggle("has-error")
                                            nf_div.classList.toggle("has-feedback")
                                            pf_div.classList.toggle("has-error")
                                            pf_div.classList.toggle("has-feedback")

                                            document.getElementById('editFoodx1').style.visibility = "visible";
                                            document.getElementById('editFoodx2').style.visibility = "visible";
                                            
                                    }

                                };
                                
                            };


                            xmlhttp.open("GET","some-function/function.php?editAddFoodName="+nf.value+"&editAddFoodPrice="+pf.value+"&editAddFoodId="+id.value,true);
                           
                            xmlhttp.send();


                    
                    }else{
                       
                        var nf_div = document.getElementById('edit-nf-div');
                        var pf_div = document.getElementById('edit-pf-div');
                        if(resultnf!=null){
                            nf_div.classList.toggle("has-error");
                            nf_div.classList.toggle("has-feedback");
                            document.getElementById('editFoodx1').style.visibility = "visible";
                        }
                        if(pf1.toString() ==  'NaN'){
                            pf_div.classList.toggle("has-error");
                            pf_div.classList.toggle("has-feedback");
                            document.getElementById('editFoodx2').style.visibility = "visible";
                        }
                        
                        
                        
                        document.getElementById('loading-close').click();
                    }
                }catch(err){
                    alert(err.message);
                    document.getElementById('loading-close').click();
                }
			}
          
          function deleteAddFood(id, name){
              try{
                  document.getElementById('delete-Phrase').innerHTML = "Are you sure to delete - "+name+" .";
                    document.getElementById('delete-id').value = id;
                    document.getElementById('deleteFood-open').click();
              }catch(err){
                  alert(err.message);
              }
            
        }
          function deleteAddFood2(){

                try{
                        
                        document.getElementById('loading-open').click();
                        var id = document.getElementById('delete-id');
                   
                    
                        
                    
                    
                        if(id!=""){
                            
                           if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }
                       
                            xmlhttp.onreadystatechange = function(){
                                 
                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                        
                                  
                                    var result = xmlhttp.responseText;
                                    if(result == "success"){
                                       
                                        loadAddFood();
                                        document.getElementById('loading-close').click();
                                        document.getElementById('deleteFood-close').click();
                                        
                                    }else{
                                            document.getElementById('loading-close').click();
                                            alert("Unable to delete contact your developer.");
                                            
                                    }

                                };
                                
                            };


                            xmlhttp.open("GET","some-function/function.php?deleteAddFoodId="+id.value,true);
                           
                            xmlhttp.send();


                    
                    }else{
                       
                        alert("Unable to delete contact your developer.");
                        document.getElementById('loading-close').click();
                    }
                }catch(err){
                    alert(err.message);
                    document.getElementById('loading-close').click();
                }
			}
      </script>
  </body>
</html>
