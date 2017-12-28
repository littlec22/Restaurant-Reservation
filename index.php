<?php
    session_start();

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
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" href="../lib/w3.css">
	
	
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
                        <a href="#home"><span class="glyphicon glyphicon-home"></span>  Home</a>
                    </li >
                    <li class="nav-simple-btn">
                        <a href="#reservation"><span class="glyphicon glyphicon-book"></span>   Reservation</a>
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


    <!-- Header -->
    <a name="about"></a>
   <!--  <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Now Serving!</h1>
                        <h3>Visit our Wet Market teeming with wide selection of Fresh Seafood.</h3>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                            </li>
                            <li>
                                <a href="https://github.com/IronSummitMedia/startbootstrap" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-default btn-lg"><i class="fa fa-facebook fa-fw"></i> <span class="network-name">Linkedin</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
       

    </div> -->
	<header id="myCarousel" class="carousel slide" >
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url( img/sf3.jpg);"></div>
               <!-- <div class="carousel-caption">
                    <h2  class="carousel-h2-caption">“Your KITCHEN Away from HOME”
</h2>
                </div>-->
            </div>
            <div class="item">
                <div class="fill" style="background-image:url( img/sf23.jpg);"></div>
               <!-- <div class="carousel-caption">
                    <h2  class="carousel-h2-caption">Caption 2</h2>
                </div>-->
            </div>
            <div class="item">
                <div class="fill" style="background-image:url( img/sf17.jpg);"></div>
               <!-- <div class="carousel-caption" >
                    <h2 class="carousel-h2-caption">Caption 3</h2>
                </div>-->
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>
    <!-- /.intro-header -->

    <!-- Page Content -->

	<a  name="home"></a>
    <div class="content-section-a">

        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Now Serving!</h2>
                    <p class="lead">Visit our Wet Market teeming with wide selection of Fresh Seafood. 
                    <br>
                        Be amazed with our refreshing gigantic waterfalls! Make yourself feel at home as we serve you in a very homey provincial atmosphere.
                        <br>
                        Dine and relax in our open area Nipa Hut sitting in our garden with your family and friends!
                        <br>
                    
                    </p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive home-preview-photo" src=" img/calleemploy.jpg" alt="">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->

    <div class="content-section-b">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">We have the place and we surely have the best food you simply can't resist.</h2>
                    <p class="lead">Here at Calle Preciousa we do everything from scratch.
                        <br>
                        You can touch it live or see it fresh frozen. We get the supply almost everyday.
                        <br>
                        If you really are a seafood lover you would know from the first bite!</p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive home-preview-photo" src=" img/vn9.jpg" alt="">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-b -->
    <a  name="reservation"></a>
    <div class="content-section-a">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">We accept reservation</h2>
                    <p class="lead"> 

                    Baptismal  <span class="glyphicon glyphicon-ok-circle"></span>
                    Birthdays  <span class="glyphicon glyphicon-asterisk"></span>
                    Date Night  <span class="glyphicon glyphicon-asterisk"></span>
                    Catering  <span class="glyphicon glyphicon-asterisk"></span>
                    On/Off site  <span class="glyphicon glyphicon-asterisk"></span>
                    Civil Wedding  <span class="glyphicon glyphicon-asterisk"></span>
                    Conference  <span class="glyphicon glyphicon-asterisk"></span>
                    Reception  <span class="glyphicon glyphicon-asterisk"></span>
                    Reunion  <span class="glyphicon glyphicon-asterisk"></span>
                    Product Launching  <span class="glyphicon glyphicon-asterisk"></span>
                    Team Building  <span class="glyphicon glyphicon-asterisk"></span>
                    Surprise Party


                     </p>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-lg" style="background:#421C1E !important;color:white !important" onclick="window.location='reservation.php'"><span class="glyphicon glyphicon-book"></span> Book your reservation</button>
                          
                    </div>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive home-preview-photo" src=" img/2.jpg" alt="">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->

    
     <div class="content-section-b">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                   <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">You are welcome every <br>Monday – Sunday <br>from 10:00 am  to 11:00 pm</h2>
                    <p class="lead">And lets try our fresh specialty seafood.  </p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive home-preview-photo" src=" img/vn9.jpg" alt="">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-b -->
    
	<a  name="contact"></a>
    <div class="banner">

        <div class="container">

            <div class="row">
                <div class="col-lg-5">
                    <h2>Connect Us:</h2>
                </div>
                <div class="col-lg-7">
                    <ul class="list-inline banner-social-buttons">
                        <li>
                            <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                        </li>
                        <li>
                            <a href="https://github.com/IronSummitMedia/startbootstrap" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-linkedin fa-fw"></i> <span class="network-name">Linkedin</span></a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.banner -->

    <!-- Footer -->
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
              <button type="button" class="btn btn-success btn-block" style="background-color:#421C1E;" onclick="try{loginUser('index.php');}catch(err){alert(err.message);}"><span class="glyphicon glyphicon-off"></span> Login</button>
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
                <p id="error-p-reg" style="font-weight:100; background:#ffb3b3 !important;padding:10px 5px 10px 5px; border-radius:5px; display:none;"></p>
                <form class="form-horizontal" action="f/function.php" method="post">
          
                    <div class="form-group" id="fnReg-div">
                      <label class="control-label col-sm-4" for="email">First name:</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="fnReg" name="fnReg">
                      </div>
                    </div>
                    <div class="form-group" id="lnReg-div">
                      <label class="control-label col-sm-4" for="email">Last name:</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="lnReg" name="lnReg">
                      </div>
                    </div>
                    <div class="form-group" id="unReg-div">
                      <label class="control-label col-sm-4" for="email">Username:</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="unReg" name="unReg">
                      </div>
                    </div>
                    <div class="form-group" id="pwReg-div">
                      <label class="control-label col-sm-4" for="email">Password:</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" id="pwReg" name="pwReg">
                      </div>
                    </div>
                    <div class="form-group" id="repwReg-div">
                      <label class="control-label col-sm-4" for="email">Repeat Password:</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" id="repwReg" name="repwReg" >
                      </div>
                    </div>
                    <div class="form-group" id="emailReg-div">
                      <label class="control-label col-sm-4" for="email">Email:</label>
                      <div class="col-sm-8">
                        <input type="email" class="form-control" id="emailReg"  title="We need your email address to contact you." name="emailReg">
                      </div>
                    </div>
                    <div class="form-group" id="cnReg-div">
                      <label class="control-label col-sm-4" for="email">Contact No. :</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="cnReg"   title="We need your contact no. to contact you." name="cnReg">
                      </div>
                    </div>
                    <div class="form-group" id="dobReg-div">
                      <label class="control-label col-sm-4" for="email">Date of Birth:</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control" id="dobReg" placeholder="" name="dobReg">
                      </div>
                    </div>


                    <div class="form-group" >        
                      <div class="col-sm-offset-2 col-sm-8">
                            <button type="submit" class="btn btn-success btn-block" style="display:none;" id="register-submit" name="register-submit"></button>
                            <a class="btn btn-success btn-block" onclick="try{registration();}catch(err){alert(err.message);}">Register</a>
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
    <script src="f/js1.js"></script>
	
    
    <script>
         function registration(){
            try{
                        
                    
                    document.getElementById('loading-open').click();
                     var fn= document.getElementById('fnReg'); 
                     var ln = document.getElementById('lnReg'); 
                     var un = document.getElementById('unReg'); 
                     var pw = document.getElementById('pwReg'); 
                     var repw = document.getElementById('repwReg'); 
                     var email = document.getElementById('emailReg'); 
                     var cn = document.getElementById('cnReg'); 
                     var dob = document.getElementById('dobReg'); 
                     var cn = document.getElementById('cnReg'); 
                    var output = "";       
                
                var count = 0;
                if((fn.value=="")){
                    document.getElementById('fnReg-div').classList.toggle("has-error");
                    document.getElementById('fnReg-div').classList.toggle("has-feedback");
                    count++;
                }
                if(ln.value==""){
                    document.getElementById('lnReg-div').classList.toggle("has-error");
                    document.getElementById('lnReg-div').classList.toggle("has-feedback");
                    count++;
                }
                if((un.value=="")||(un.value.length<=6)){
                    document.getElementById('unReg-div').classList.toggle("has-error");
                    document.getElementById('unReg-div').classList.toggle("has-feedback");
                    output = output+"Username must be greater than equal to 6 characters. <br>";
                    count++;
                }
                if((pw.value=="")||(pw.value.length<=8)){
                    document.getElementById('pwReg-div').classList.toggle("has-error");
                    document.getElementById('pwReg-div').classList.toggle("has-feedback");
                    output = output+"Password must be greater than equal to 8 characters.<br> ";
                    document.getElementById('repwReg-div').classList.toggle("has-error");
                    document.getElementById('repwReg-div').classList.toggle("has-feedback");
                    count++;
                }else{
                    if(repw.value!=pw.value){
                        document.getElementById('pwReg-div').classList.toggle("has-error");
                        document.getElementById('pwReg-div').classList.toggle("has-feedback");
                        document.getElementById('repwReg-div').classList.toggle("has-error");
                        document.getElementById('repwReg-div').classList.toggle("has-feedback");
                        output = output+"Password not match.<br> ";
                        count++;
                    }
                }
                if(cn.value==""){
                    document.getElementById('cnReg-div').classList.toggle("has-error");
                    document.getElementById('cnReg-div').classList.toggle("has-feedback");
                    count++;
                }
                
                var str = email.value;
                var patt1 = /.com$/g;
                var result1 = str.match(patt1);
          
                var patt2 = /@+/g;
                var result2 = str.match(patt2);
                if((result1=="")||(result2=="")||(result1==null)||(result2==null)||(str.value == "")){
                    document.getElementById('emailReg-div').classList.toggle("has-error");
                    document.getElementById('emailReg-div').classList.toggle("has-feedback");
                    count++;
                }
                            
                if(count==0){
                    
                    if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }
                       
                            xmlhttp.onreadystatechange = function(){
                                 
                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                        
                                  
                                    var result = xmlhttp.responseText;
                                    if(result == "Success"){
                                        
                                        
                                        document.getElementById('loading-close').click();
                                        document.getElementById('register-submit').click();
                                        
                                        
                                    }else{
                                        
                                        document.getElementById('loading-close').click();
                                        
                                            
                                            
                                    }

                                };
                                
                            };
                
                           
                            xmlhttp.open("GET","f/function.php?check_un="+un,true);
                           
                            xmlhttp.send();

                }else{
                    document.getElementById('error-p-reg').innerHTML = output;
                    document.getElementById('error-p-reg').style.display = "block";
                    document.getElementById('loading-close').click();
                }
                           

                }catch(err){
                    alert(err.message);
                    
                    document.getElementById('loading-close').click();
                    
                }
        }
      
       
        $('.carousel').carousel({
			interval: 5000 //changes the speed
		});
        
        
        
        
              
    </script>
	
</body>

</html>
