<?php
    session_start();
    if(!isset($_SESSION['cust_id'])){
        header('location : index.php');
    }
?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

        <title>Calle Preciousa</title>

    <!-- Bootstrap Core CSS -->
    <link href=" css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href=" css/landing-page.css" rel="stylesheet">

	   <link href=" css/modern-business.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href=" font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href=" font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href=" ownjs/js1.js" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" href="lib/w3.css">
	
	<body>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation" >
        <div class="container topnav" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="#"><img style="max-height:200%;margin-top:-10px;" src="img/logo1.png"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-simple-btn">
                        <a href="index.php"><span class="glyphicon glyphicon-home"></span>  Home</a>
                    </li >
                    <li class="nav-simple-btn">
                        <a href="reservation.php"><span class="glyphicon glyphicon-book"></span>   Reservation</a>
                    </li>
                      <?php
                        if(isset($_SESSION['cust_id'])){
                            ?>
                            <li class="nav-simple-btn">
                                <a href="calendar.php"><span class="glyphicon glyphicon-calendar"></span>   Calendar Event</a>
                            </li>
                    <?php
                        }
                    ?>
                    <li class="nav-simple-btn">
                        <a data-toggle="modal" data-target="#myModalMenu" style="cursor:pointer;"><span class="glyphicon glyphicon-bookmark"></span>    Menu</a>
                    </li>
                    <li class="nav-simple-btn">
                        <a data-toggle="modal" data-target="#myModalPackage" style="cursor:pointer;"><span class="glyphicon glyphicon-star"></span>     Package</a>
                    </li>
                    
                    <?php
                        if(isset($_SESSION['cust_id'])){
                            ?>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="background:white;color:#421C1E !important;">Hi <?php echo   $_SESSION['first_name'];?>
                                    <span class="caret"></span></a>
                                    <ul class="dropdown-menu" style="background:#421C1E;">
                                      <li><a href="#" class="dropdown-a">Account</a></li>
                                      <li><a href="logout.php" class="dropdown-a">Log-out</a></li>
                                    </ul>
                                </li>
                            <?php
                        }else{
                            ?>
                                <li class="nav-simple-btn">
                                    <a data-toggle="modal" data-target="#myModalLogin" style="cursor:pointer;"><span class="glyphicon glyphicon-log-in"></span >    Sign in</a>
                                </li>
                                <li class="nav-simple-btn">
                                    <a  id="register-open" data-toggle="modal" data-target="#myModalSignup" style="cursor:pointer;" ><span class="glyphicon glyphicon-registration-mark"></span>    Sign up</a>
                                </li>
                            
                            <?php
                        }
                    
                    ?>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">
        <div class="panel panel-success">
      <div class="panel-heading"><div class="jumbotron" style="background:transparent !important;">
                <h1>Succes Reservation!</h1> 
                
              </div></div>
        <div class="panel-body">
            <a> Click this to view your reservation details, </a>
                <p> or go to in calendar event.</p>
                
        </div>
    </div>
    
    </div>
   

    <!-- Footer
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#about">About</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#services">Services</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#contact">Contact</a>
                        </li>
                    </ul>
                    <p class="copyright text-muted small">Copyright &copy; Your Company 2014. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>
 -->
        <!-- MEnu  Modal -->
    <div id="myModalMenu" class="modal fade" role="dialog">
      <div class="modal-dialog modal-md" >

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Our Menu</h4>
          </div>
          <div class="modal-body">
            <div id="myCarouselMenu" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarouselMenu" data-slide-to="0" class="active"></li>
              <li data-target="#myCarouselMenu" data-slide-to="1"></li>
              <li data-target="#myCarouselMenu" data-slide-to="2"></li>
              <li data-target="#myCarouselMenu" data-slide-to="3"></li>
              <li data-target="#myCarouselMenu" data-slide-to="4"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <div class="item active">
                  <center>
                        <img src=" img/m1.jpg" alt="" width="460" height="700">
                  </center>
                
              </div>

              <div class="item">
                <center>
                        <img src=" img/m2.jpg" alt="" width="460" height="700">
                  </center>
              </div>

              <div class="item">
                <center>
                        <img src=" img/m3.jpg" alt="" width="460" height="700">
                  </center>
              </div>

              <div class="item">
                <center>
                        <img src=" img/m4.jpg" alt="" width="460" height="700">
                  </center>
              </div>
                <div class="item">
                <center>
                        <img src=" img/m5.jpg" alt="" width="460" height="700">
                  </center>
              </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarouselMenu" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarouselMenu" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>

          </div>
          
        </div>

      </div>
    
     <!-- package  Modal -->
    <div id="myModalPackage" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg" >

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Our Menu</h4>
          </div>
          <div class="modal-body">
            <div id="myCarouselPackage" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarouselPackage" data-slide-to="0" class="active"></li>
              <li data-target="#myCarouselPackage" data-slide-to="1"></li>
             
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner " role="listbox">
                <div class="item active">
                  <center>
                        <img src=" img/package1.png" alt="" width="460" height="700">
                  </center>
                
              </div>

              <div class="item">
                <center>
                        <img src=" img/m2.jpg" alt="" width="460" height="700">
                  </center>
              </div>

              

              

            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarouselPackage" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarouselPackage" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>

          </div>
          
        </div>

      </div>

      <!-- Modal -->
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
  
    <div class="modal fade" id="myModalSignup" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;background-color:#421C1E;">
          <button type="button" class="close" data-dismiss="modal" style="color:white !important;" >&times;</button>
          <h4 style="color:white !important;"><span class="glyphicon glyphicon-lock"></span> Register</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px; overflow-y:scroll; height:400px;">
            <div >
                <form class="form-horizontal">
          
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="email">First name:</label>
                      <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="email">Last name:</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="email" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="email">Username:</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="email" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="email">Password:</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" id="email" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="email">Email:</label>
                      <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" placeholder="Enter email" title="We need your email address to contact you.">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="email">Contact No. :</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="email" placeholder="Enter email"  title="We need your contact no. to contact you.">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="email">Date of Birth:</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control" id="email" placeholder="Enter email">
                      </div>
                    </div>


                    <div class="form-group">        
                      <div class="col-sm-offset-2 col-sm-8">
                        <button type="submit" class="btn btn-success btn-block">Register</button>
                          <button type="button" class="btn btn-danger btn-block" data-dismiss="modal" > Cancel</button>
                      </div>
                    </div>

                  </form>
            </div>
          
        </div>
        
      </div>
      
    </div>
  </div> 
    <!--loading modal-->
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
  
    <!-- jQuery -->
    
    
    <script src=" js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src=" js/bootstrap.min.js"></script>
	
    
    <script>
        
        
        
        
        $('.carousel').carousel({
			interval: 5000 //changes the speed
		});
        
        
              
    </script>
	
</body>

</html>
