
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
    <meta name="author" content="">

        <title>Calle Preciousa</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/landing-page.css" rel="stylesheet">

	   <link href=" css/modern-business.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="../ownjs/js1.js" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" href="lib/w3.css">
	
</head>
    <style>
       .dropdown-a:hover{
        color: black !important;
         }
        body{
            background: url(../img/admin-bg.png);
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
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

     <div class="modal fade" id="myModalLogin" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;background-color:#421C1E;">
          <button id="login-close" type="button" class="close" data-dismiss="modal" style="color:white !important;" >&times;</button>
          <h4 style="color:white !important;"><span class="glyphicon glyphicon-lock"></span> Login</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form">
            <div id="un-div" class="form-group">
              <label class="control-label" for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
              <input type="text" class="form-control" id="uname" placeholder="Enter email">
                 <span id="loginx1" class="glyphicon glyphicon-remove form-control-feedback" style="visibility:hidden;"></span>
            </div>
            <div id="pw-div" class="form-group ">
                <label class="control-label" for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                <input type="password" class="form-control" id="pword" placeholder="Enter password">
                <span id="loginx2" class="glyphicon glyphicon-remove form-control-feedback"  style="visibility:hidden;"></span>
            </div>
            <div class="checkbox">
              <a href="#">Forgot password?</a>
            </div>
              <button type="button" class="btn btn-success btn-block" style="background-color:#421C1E;" onclick="try{loginUser();}catch(err){alert(err.message);}"><span class="glyphicon glyphicon-off"></span> Login</button>
              <button type="button" class="btn btn-danger btn-block" data-dismiss="modal" > Cancel</button>
               <center>
                 
              </center>
          </form>
        </div>
        
      </div>
      
    </div>
  </div> 
                

    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../f/js1.js"></script>    
  </body>
</html>
