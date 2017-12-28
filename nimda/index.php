
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
            <a href="" class="navbar-brand" style="color: white !important;">Calle Preciousa</a>
            
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
            <a href="index.php" class="list-group-item side-nav-active"><span class="glyphicon glyphicon-home"></span>    Home</a>
            <a href="calendarManaging.php" class="list-group-item"><span class="glyphicon glyphicon-calendar"></span>     Manage Calendar</a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-tasks"></span>     Reservation</a>
            <a href="addFood.php" class="list-group-item "><span class="glyphicon glyphicon-tasks"></span>     Additional Food</a>
            <a href="pending.php" class="list-group-item "><span class="glyphicon glyphicon-tasks"></span>     Pending Reservation</a>
            <a href="reserved.php" class="list-group-item "><span class="glyphicon glyphicon-tasks"></span>     Reserved</a>
        </div>
    </div>
      
      <div class="body-content container ">
            <?php
                $sql = mysqli_query($con,"SELECT count(`event_id`) FROM `event_information` WHERE `event_status` LIKE '%Pending' ")or die(mysqli_error($con));
                $res1 = mysqli_fetch_array($sql);
                $pendingEvent;
                if($res1){
                    $pendingEvent = $res1[0];
                    
                    
                }
         
                $sql = mysqli_query($con,"SELECT `typeEvent`,`dateEvent` FROM `event_information` WHERE `dateEvent` > '".date('Y-m-d')."'  ORDER BY `dateEvent` LIMIT 5 ")or die(mysqli_error($con));
                
                $upcomingEvent = array();
                 $i= 0;
                while($res1 = mysqli_fetch_array($sql)){
                    $upcomingEvent[$i] = $res1[0]." - ".$res1[1];

                    $i++;
                    
                }
        
                $sql = mysqli_query($con,"SELECT count(`event_id`) FROM `event_information` WHERE `event_status` LIKE '%Cancel' ")or die(mysqli_error($con));
                $res1 = mysqli_fetch_array($sql);
                $cancelEvent;
                if($res1){
                    $cancelEvent = $res1[0];
                    
                    
                }
        
        
        ?>
        <div class="">
             <div class=" body-container row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                       
                <div class="row" >
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                        <h1>Event Update</h1>
                    </div>
                </div>
                            
                <!--Propducts update here-->
                <div class="row">
                    <!-- low level stock-->
                    <div class=" col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="panel panel-primary">
                          <div class="panel-heading" style="padding-bottom:25px;">
                            <h3 class="panel-title" style="float:left;">Pending Request Event</h3>
                            <a href="#" style="color:white;"><span class="glyphicon glyphicon-open" style="float:right;"></span></a>
                          </div>
                          <div class="panel-body" style="padding:0px;">
                           
                              <center><h1><?php echo  $pendingEvent;?></h1></center>
                          </div>
                        </div>

                    </div>
                    
                    <!-- New added Product  -->
                    <div class=" col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="panel  panel-success">
                          <div class="panel-heading" style="padding-bottom:25px;">
                            <h3 class="panel-title" style="float:left;">Upcoming Event</h3>
                            <a href="#" style="color:white;"><span class="glyphicon glyphicon-open" style="float:right;"></span></a>
                          </div>
                          <div class="panel-body" style="padding:0px;">
                            <ul class="list-group" style="padding:0px;margin:0px;">
                                <?php
                                    foreach($upcomingEvent as $value){
                                        ?>
                                            <li class="list-group-item">
                              
                                            <?php echo $value;?>
                                          </li>
                                
                                        <?php
                    
                                    }
                                ?>
                              
                            </ul>
                          </div>
                        </div>

                    </div>
                    <!-- New update Product  -->
                    <div class=" col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="panel panel-danger">
                          <div class="panel-heading" style="padding-bottom:25px;">
                            <h3 class="panel-title" style="float:left;">Cancel Event</h3>
                            <a href="#" style="color:white;"><span class="glyphicon glyphicon-open" style="float:right;"></span></a>
                          </div>
                          <div class="panel-body" style="padding:0px;">
                            <center><h1><?php echo $cancelEvent;?></h1></center>
                          </div>
                        </div>

                    </div>
                </div>
                <hr>
                 <!--Total Event of this month-->
                <?php
                   $date = date_create(date("Y-m-d"));
                    $sql = mysqli_query($con,"SELECT  `typeEvent`, `areaEvent`, `paxEvent` , `dateEvent` ,`event_hours`,`event_status`, `cust_id` FROM `event_information` WHERE `dateEvent` LIKE '".date_format($date,"Y-m")."%' ORDER BY `dateEvent` ")or die(mysqli_error($con));
                    
                    $eventThisMonth = array();
                    $i=0;
                    while($res1 = mysqli_fetch_array($sql)){
                        $ii=0;
                        $eventThisMonth[$i][$ii] = $res1['typeEvent'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['areaEvent'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['paxEvent'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['dateEvent'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['event_hours'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['event_status'];
                       
                        $i++;
                        }
                    
                ?>
                       
                <div class="row" >
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <h1>Total Event of this Month : <?php echo $i++; ?></h1>
                        
                    </div>
                </div>
                <div class="row">
                    <!-- progress report -->
                    <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-striped">
                            <thead >
                              <tr >
                                <th style="font-weight:900 !important;">Event Type</th>
                                <th style="font-weight:900 !important;">Area</th>
                                <th style="font-weight:900 !important;">No. of pax</th>
                                <th style="font-weight:900 !important;">Date of Event</th>
                                <th style="font-weight:900 !important;">Event Hours</th>
                                <th style="font-weight:900 !important;">Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                
                                for($i=0;$i < count($eventThisMonth);$i++){
                                   echo "<tr>";
                                    echo "<th>".$eventThisMonth[$i][0]."</th>";
                                    echo "<th>".$eventThisMonth[$i][1]."</th>";
                                    echo "<th>".$eventThisMonth[$i][2]."</th>";
                                    echo "<th>".$eventThisMonth[$i][3]."</th>";
                                    echo "<th>".$eventThisMonth[$i][4]."</th>";
                                    echo "<th>".$eventThisMonth[$i][5]."</th>";
                                    echo "</tr>";
                                }
                                
                                ?>
                                
                            </tbody>
                          </table>
                    </div>
           
      
                </div>
                    <hr>
                    <!--Unpaid and Non-fully paid-->
                <?php
                   $date = date_create(date("Y-m-d"));
                    $sql = mysqli_query($con,"SELECT  `typeEvent`, `areaEvent`, `paxEvent` , `dateEvent` ,`payment_status`,`event_status`, `cust_id` FROM `event_information` WHERE (`payment_status` = 'Unpaid' OR `payment_status` = 'NonFullyPaid')  ORDER BY `dateEvent`")or die(mysqli_error($con));
                    
                    $eventThisMonth = array();
                    $i=0;
                    while($res1 = mysqli_fetch_array($sql)){
                        $ii=0;
                        $eventThisMonth[$i][$ii] = $res1['typeEvent'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['areaEvent'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['paxEvent'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['dateEvent'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['event_status'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['payment_status'];
                       
                        $i++;
                        }
                    
                ?>
                       
                <div class="row" >
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <h1>Unpaid and Non-fully paid</h1>
                        
                    </div>
                </div>
                <div class="row">
                    <!-- progress report -->
                    <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-striped">
                            <thead >
                              <tr >
                                <th style="font-weight:900 !important;">Event Type</th>
                                <th style="font-weight:900 !important;">Area</th>
                                <th style="font-weight:900 !important;">No. of pax</th>
                                <th style="font-weight:900 !important;">Date of Event</th>
                                <th style="font-weight:900 !important;">Event Hours</th>
                                <th style="font-weight:900 !important;">Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                
                                for($i=0;$i < count($eventThisMonth);$i++){
                                   echo "<tr>";
                                    echo "<th>".$eventThisMonth[$i][0]."</th>";
                                    echo "<th>".$eventThisMonth[$i][1]."</th>";
                                    echo "<th>".$eventThisMonth[$i][2]."</th>";
                                    echo "<th>".$eventThisMonth[$i][3]."</th>";
                                    echo "<th>".$eventThisMonth[$i][4]."</th>";
                                    echo "<th>".$eventThisMonth[$i][5]."</th>";
                                    echo "</tr>";
                                }
                                
                                ?>
                                
                            </tbody>
                          </table>
                    </div>
           
      
                </div>
        
                    
                        

                        

                        <footer>
                            <div class="row">
                              <div class="col-lg-12">

                                <ul class="list-unstyled">
                                  <li class="pull-right"><a href="#top">Back to top</a></li>
                                  <li><a href="http://news.bootswatch.com" onclick="pageTracker._link(this.href); return false;">Blog</a></li>
                                  <li><a href="http://feeds.feedburner.com/bootswatch">RSS</a></li>
                                  <li><a href="https://twitter.com/bootswatch">Twitter</a></li>
                                  <li><a href="https://github.com/thomaspark/bootswatch/">GitHub</a></li>
                                  <li><a href="../help/#api">API</a></li>
                                  <li><a href="../help/#support">Support</a></li>
                                </ul>
                                <p>Made by <a href="http://thomaspark.co" rel="nofollow">Thomas Park</a>. Contact him at <a href="mailto:thomas@bootswatch.com">thomas@bootswatch.com</a>.</p>
                                <p>Code released under the <a href="https://github.com/thomaspark/bootswatch/blob/gh-pages/LICENSE">MIT License</a>.</p>
                                <p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>.</p>

                              </div>
                            </div>

                          </footer>

                    </div>
                </div>
            </div>
       </div>
      

    <script src="asset/js/jquery.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>
   
  </body>
</html>
