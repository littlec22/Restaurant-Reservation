
<?php
    session_start();
    require_once 'f/connect.php';
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

<body style="background:rgb(242, 242, 242);">

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
                        <a href=""><span class="glyphicon glyphicon-book"></span>   Reservation</a>
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
    <?php
        if(!isset($_SESSION['cust_id'])){
        ?>
        
    
    <div class="container"id="noUserDiv">
            <div class="row">
            <div class="col-lg-3 col-md-3"></div>
            <div class="col-lg-6 col-md-3">
                <div style="margin-top:100px;background:white;border-radius:10px;padding:50px 0 50px 0;">
                    <center>
                        <h1 style="font-size:50px;color:#ff4d4d !important;"><span class="glyphicon glyphicon-warning-sign"></span></h1><br>
                        <h4>You need to sign up to proceed in event reservation</h4>
                    </center>
                </div>    
            </div>
            <div class="col-lg-3 col-md-3"></div>
            </div>
            
    </div>
        
        <?php    
        }else{
        ?>
        
    
    <div class="container" id="reservationDiv">
      
      <div class="row">
            <div class="col-sm-12" >
                <h1>Set up reservation details</h1>
            </div>
      </div>
        
        <div class="row">
             <form method="post" action="f/function.php">
                <div class="col-md-3"  >
                   
                </div>

                <div class="col-md-6"  style="background-color:rgb(255, 255, 255);" >
                    
                    <div id="event-info">
                        <h1>Event Information</h1>
                        <hr></hr>
                        <p id="warning-1"style="font-weight:100; background:#ffb3b3 !important;padding:10px 5px 10px 5px; border-radius:5px; display:none;"> <span class="glyphicon glyphicon-warning-sign"></span>  We cannot check your event information, some input are wrong.</p>
                         <div class="form-group">
                          <label for="sel1">Type of event:</label>
                          <select class="form-control" id="typeEvent" name="typeEvent">
                            <option>Weddings</option>
                            <option>Christening</option>
                            <option>Birthdays</option>
                            <option>Reunion</option>
                            <option>Meeting</option>
                            <option>Special occasions</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="sel1"  >Select of Area:</label>
                          <select class="form-control" id="areaEvent" name="areaEvent" onchange="try{areasMaxPax(this);}catch(err){alert(err.message);}">
                            <option value = "VIP 1 max capacity is 30 pax"  >
                                VIP 1 max capacity is 30 pax</option>
                            <option value = "VIP 2 max capacity is 40 pax">
                                VIP 2 max capacity is 40 pax</option>
                            <option value="VIP 3 max capacity is 50 pax">
                                VIP 3 max capacity is 50 pax</option>
                            <option value="Garden Area max capacity is 150 pax">
                                Garden Area max capacity is 150 pax</option>
                            <option value="Dine-in max capacity is 40 pax">
                                Dine-in max capacity is 40 pax</option>

                          </select>
                        </div>
                        <div class="form-group">
                          <label for="usr">Area Rate:</label>
                          <input type="text" class="form-control" id="areaRate" name="areaRate" value="P 1,000 per hour" disabled>
                        </div>
                        <div class="form-group">
                          <label for="usr">No. of Pax:</label>
                          <input type="number" class="form-control" id="paxEvent" name="paxEvent" min="1"  max="30" onchange="document.getElementById('cost-no-of-pax').innerHTML = this.value;">
                        </div>
                        <div class="form-group">
                          <label for="usr">Event Representative:</label>
                          <input type="text" class="form-control" id="repEvent" name="repEvent" >
                        </div>
                        <div class="form-group">
                          <label for="usr">Date of Event:</label>
                        
                          <input type="date" class="form-control" id="dateEvent" name="dateEvent" onload="try{dateSetMax(this);}catch(err){alert(err.message);}" <?php if(isset($_GET['eventDate'])){echo "value='".$_GET['eventDate']."'";}?>>
                        </div>
                        <div class="form-group">
                          <label for="usr">Time start:</label>
                          <input type="time" class="form-control" id="startEvent" name="startEvent" min="06:00" max="23:00" value="07:00">
                        </div>
                        <div class="form-group">
                          <label for="usr">Time end:</label>
                          <input type="time" class="form-control" id="endEvent" name="endEvent" min="06:00" max="23:00" value="07:00">
                        </div>
                        <div class="form-group">
                          <p id="warning-2"style="font-weight:100; background:#ffb3b3 !important;padding:10px 5px 10px 5px; border-radius:5px;display:none; "> <span class="glyphicon glyphicon-warning-sign"></span>  We cannot check your event information, some input are wrong.</p>          
                          <input type="button" class="form-control" id="checkEventInfo" value="Check Availability" style="background:#421C1E ; color:white !important;" onclick="checkAvailability()">
                        </div>

                    </div>
                    
                    <div id="package-info" style="display:none;">
                        <center>
                            <a style='cursor:pointer;background:#421C1E !important; color:white !important;'  class='btn btn-block' onclick="alert('asdas');try{document.getElementById('event-info').style.display = 'block';document.getElementById('package-info').style.display = 'none';}catch(err){alert(er.message);}">Edit your event information</a>
                        </center>
                        <h1>Package Information</h1>
                        <hr></hr>
                        <div class="col-xs-6">
                             <div class="radio">
                                <label class="radio" style="font-weight:900" ><input id="typePackage1" type="radio"  name="typePackage" value="Package 1" onchange="packageSelect(this);packagePrice(this);" checked>  Package 1</label>
                            </div>
                        </div >
                            <div class="col-xs-6">
                                 <div class="radio">
                                    <label class="radio " style="font-weight:900"><input type="radio"  name="typePackage" value="Package 2" onchange="packageSelect(this);packagePrice(this);" >  Package 2</label>
                                </div>
                            </div>
                    
                            <div id="packageLaman">
                                <div class="form-group">
                                  <label for="sel1"  >Chicken:</label>
                                  <select class="form-control"  name="chickenPackage" >
                                    <option value = "chicken1"  >
                                       1</option>
                                    <option value = "chicken2">
                                        2</option>
                                    <option value=  "chicken3">
                                        3</option>
                                    <option value=  "chicken4">
                                        4</option>
                                    <option value=  "chicken5">
                                        6</option>

                                  </select>
                                </div>

                                <div class="form-group">
                                  <label for="sel1"  >Fish Fillet / Tahong:</label>
                                  <select class="form-control" name="fishPackage">
                                    <option value = "Fish Fillet"  >
                                       Fish Fillet</option>
                                    <option value = "Tahong">
                                        Tahong</option>

                                  </select>
                                </div>
                               <div class="form-group">
                                  <label for="sel1"  >Chopsuey / Pakbet:</label>
                                  <select class="form-control" name="vegetablePackage">
                                    <option value = "Chopsuey"  >
                                       Chopsuey</option>
                                    <option value = "Pakbet">
                                        Pakbet</option>

                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="sel1"  >Rice :</label>
                                  <select class="form-control" name="ricePackage">
                                    <option value = "Steamed Rice"  >
                                       Steamed Rice</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="sel1"  >Iced Tea:</label>
                                  <select class="form-control" name="icedteaPackage">
                                    <option value = "Iced Tea"  >
                                       Iced Tea</option>
                                  </select>
                                </div>
                              <div>
                                   <label for="sel1"  >Glass of lemon:</label>
                                  <select class="form-control" name="lemonPackage">
                                    <option value = "Glass of lemon"  >
                                       Glass of lemon</option>
                                  </select>
                                </div>
                                <div>
                                    <label for="sel1"  >Buko Pandan:</label>
                                      <select class="form-control" name="bukoPackage">
                                        <option value = "Buko Pandan"  >
                                           Buko Pandan</option>
                                      </select>
                                </div>
                                
                            </div>
                            <hr>
                                <h4>Additional services</h4>
                                
                                <table id="table-additional-services" cellpadding="10" cellspacing="1" class="table table-striped">
                                      <tbody>
                                           <tr>
                                              <th style="width:150px;"><strong>Option</strong></th>
                                              
                                              <th><strong>Details</strong></th>
                                              <th><strong>Price</strong></th>
                                          </tr>
                                      <tr>
                                          <td>
                                            <input type="checkbox" class="chkBox" name="selectedItems1" value="Mobile Bar--8000" id="AOinput1" onchange="additionalServices()"/>
                                            Mobile Bar</td>
                                          <td>Basic sound and lights</td>
                                          <td>8000</td>
                                      </tr>
                                          <tr>
                                              <td>
                                                  <input type="checkbox" class="chkBox" name="selectedItems2" value="Photobooth--4500" id="AOinput2"  onchange="additionalServices()" />
                                                  Photobooth 
                                              </td>
                                              <td>Photobooth with Roving Photographer and Tarpaulin 2x4</td>
                                              <td>4500</td>
                                      </tr>
                                          <tr>
                                              <td>
                                                <input type="checkbox" class="chkBox" name="selectedItems3" value="Cake--3500" id="AOinput3" onchange="additionalServices()" />
                                                Cake
                                              </td>
                                              <td>2 layers fondant cake (Base Edible)</td>
                                              <td>3500</td>
                                      </tr>
                                          <tr>
                                              <td>
                                                  <input type="checkbox" class="chkBox" name="selectedItems4" value="Dessert Buffet--3500" id="AOinput4" onchange="additionalServices()" />
                                                  Dessert Buffet
                                              </td>
                                              <td>Dessert Buffet with fruit and non fruit dippers (good for 50 Pax)</td>
                                              <td>3500</td>
                                          </tr>
                                      </tbody>
                                      </table>
                         <br>
                         <h4>Additional Food Order</h4>
                         <div class="row">
                             <div class="col-md-9">
                                 <select class="form-control" name="" id="additionalFoodSelect">
                                        <?php
                                         $sql = mysqli_query($con,"SELECT  `additional_food_name`, `additional_food_price`FROM `additional_food_table` WHERE `additional_food_status` = 'active'")or die(mysqli_error($con));
                                        
                                        while($res1 = mysqli_fetch_array($sql)){
                                            ?>
                                                    <option value ="<?php echo $res1[0]."-".$res1[1];?>"  ><?php echo $res1[0]."-".$res1[1];?></option>
                                            <?php
                                        }
                                     
                                        ?>

                                 </select> 
                             </div>
                             <div class="col-md-3">
                                 <a class="btn btn-block btn-primary" onclick="addingFood();">Add</a>
                             </div>
                        </div>
                 
                        <table class="table table-bordered" id="additionalFoodTable">
                            <thead>
                              <tr>
                                <th style="max-width:80%;width:80%;">Additional Food
                                      
                                </th>
                                <th style="max-width:20%;width:20%;"></th>
                              </tr>
                            </thead>
                            <tbody id="additionalFoodTable-t">
                              
                              
                            </tbody>
                            
                        </table>
                          
                    <br>
                    <br>
                        <h2>Event Cost</h2>
                        <table class="table table-bordered">
                            
                            <tbody >
                              
                                <tr>
                                    <th style="max-width:60%;width:60%;">
                                         No. of Pax :
                                    </th>
                                    <th style="max-width:40%;width:40%;" id="cost-no-of-pax">
                                        0
                                    </th>
                                </tr>
                               
                                <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Event Hours :
                                    </th>
                                    <th style="max-width:40%;width:40%;" id="cost-event-hours">
                                        0 
                                    </th>
                                </tr>
                                <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Area rate per hours :
                                    </th>
                                    <th style="max-width:40%;width:40%;" id="cost-area-rate">
                                        0 
                                    </th>
                                </tr>
                                <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Area Amount :
                                    </th>
                                    <th style="max-width:40%;width:40%;" id="cost-area-amount">
                                        0 
                                    </th>
                                </tr>
                                 <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Package :
                                    </th>
                                    <th style="max-width:40%;width:40%;" id="cost-package">
                                        0 
                                    </th>
                                </tr>
                                <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Price per Head(VAT Inclusive) : 
                                    </th>
                                    <th style="max-width:40%;width:40%;"  id="cost-price-per-head">
                                        0 
                                    </th>
                                </tr>
                                <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Sub Total :
                                    </th>
                                    <th style="max-width:40%;width:40%;" id="cost-subtotal">
                                        0
                                    </th>
                                </tr>
                                <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Additional Services :
                                    </th>
                                    <th style="max-width:40%;width:40%;" id="cost-add-services">
                                        0 
                                    </th>
                                </tr>
                                <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Additional Food :
                                    </th>
                                    <th style="max-width:40%;width:40%;" id="cost-add-food">
                                        0 
                                    </th>
                                </tr>
                                <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Total :
                                    </th>
                                    <th style="max-width:40%;width:40%;" id="cost-total">
                                        0 
                                    </th>
                                </tr>
                                
                            </tbody>
                            <input type="hidden"  id="addCount" value="0" name="addCount" value="0">
                            <input type="hidden"  id="cost-total-input" name="cost-total-input" value="0">
                            <input type="hidden"  id="cost-add-food-input" name="cost-add-food-input" value="0">
                            <input type="hidden"  id="cost-add-services-input" name="cost-add-services-input" value="0">
                            <input type="hidden"  id="cost-price-per-head-input" name="cost-price-per-head-input" value="0">
                            <input type="hidden"  id="cost-package-input" name="cost-package-input" value="0">
                            <input type="hidden"  id="cost-event-hours-input" name="cost-event-hours-input" value="0">
                            <input type="hidden"  id="cost-area-rate-input" name="cost-area-rate-input" value="0">
                        </table>
                    <br>
                 
                         <input type="button" class="form-control" id="done-in-package-info" value="Done" style="background:#421C1E ; color:white !important;" data-toggle="modal" data-target="#myModalSubmit" >
                    </div>
                     
            
                    <br><br><br>
                </div>

                <div class="col-md-3"></div>
        
                <!--the submit button is in in the modal-->
                <div class="modal fade" id="myModalSubmit" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">

                          <button id="Submit-close" type="button" class="close" data-dismiss="modal" style="color:white !important;" >&times;</button>

                        <div class="modal-body" style="padding:40px 50px;">

                                <center>
                                    <h1 style="font-size:50px;"><span class="glyphicon glyphicon-envelope"></span></h1>
                                    <p>This reservation is not finally accepted by the administrator , we will need to verify first your information then we will send a message to you via text message or email. it took a maximum 3 days before to verify your reservation. 
                                    <br>
                                    We have a terms and condition in event reservation kindly read it to understand. 
                                    
                                    </p>
                                    <br>
                                    <input type="checkbox" value="agree-in-terms-&-condition" onchange="if(this.checked){document.getElementById('submit').style.display = 'block';}else{document.getElementById('submit').style.display = 'none';}"> <label>I agree in <a href="#" style="color:red !important;">terms and condition.</a></label>
                                </center>
                                
                                <input type="submit" name="reserve-submit" class="form-control" id="submit" style="background:#421C1E ; color:white !important; display:none;"> 
                        </div>

                      </div>

                    </div>
                  </div> 
                
                   
            </form>
          
      </div>
    </div>

        <?php     
        }
    ?>
    
    
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
              <button type="button" class="btn btn-success btn-block" style="background-color:#421C1E;" onclick="try{loginUser('reservation.php');}catch(err){alert(err.message);}"><span class="glyphicon glyphicon-off"></span> Login</button>
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
                            <a class="btn btn-success btn-block" onclick="registration()">Register</a>
                          <button type="button" class="btn btn-danger btn-block" data-dismiss="modal" > Cancel</button>
                      </div>
                    </div>

                  </form>
            </div>
          
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
  
    <!-- jQuery -->
    
    
    <script src=" js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src=" js/bootstrap.min.js"></script>
    <script src="f/js1.js"></script>
	
    
    <script>
        window.onload = dateSetMax(document.getElementById('dateEvent'));
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
        
    </script>
	
</body>

</html>
