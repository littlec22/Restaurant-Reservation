<?php
    
    session_start();
    $con = mysqli_connect("localhost","root","","c-preciosa");


    
    if((isset($_GET['unnname']))&&(isset($_GET['pwwword']))){
        logon($_GET['unnname'],$_GET['pwwword']);
    }elseif(isset($_POST['register-submit'])){
       registration();
    }elseif(isset($_GET['check_un'])){
       checkUsernameInRegistration($_GET['check_un']);
    }elseif((isset($_GET['event_start']))&&(isset($_GET['event_end']))){
       check_availability();
    }elseif(isset($_POST['reserve-submit'])){
       insert_reservation();
    }elseif(isset($_POST['update-event-submit'])){
       update_reservation();
    }elseif(isset($_GET['loadMyEvent'])){
       loadMyEvent();
    }elseif(isset($_GET['loadEventInfo'])){
       loadEventInfo($_GET['loadEventInfo']);
    }elseif(isset($_GET['cancelEvent'])){
       cancelEvent($_GET['cancelEvent']);
    }else{
            echo "<h1>Error 404!</h1>";
        }

function logon($un,$pw) {
        global $con;
        $un = mysqli_real_escape_string($con,$_GET['unnname']);
        $pw = mysqli_real_escape_string($con,$_GET['pwwword']);
        
        $query = mysqli_query($con,"SELECT * FROM customer_table where user_name='".$un."' AND pass_word ='".$pw."' LIMIT 1")or die(mysqli_error($con));
		$res1 = mysqli_fetch_assoc($query);
        if($res1){
       // echo "<script>alert('Invalid Credentials!')</script>";
        
       
            $_SESSION["user_name"] = $res1['user_name']; // Initializing Session
            $_SESSION["first_name"] = $res1['first_name']; // Initializing Session
            $_SESSION["last_name"] = $res1['last_name']; // Initializing Session
            $_SESSION["cust_id"] = $res1['cust_id']; // Initializing Session
            echo "success";
        }
        else{
            echo "invalid";
        }
}
function checkUsernameInRegistration($un) {
        global $con;
        $un = mysqli_real_escape_string($con,$un);
        
        
        $query = mysqli_query($con,"SELECT * FROM customer_table where user_name='".$un."' ")or die(mysqli_error($con));
		$res1 = mysqli_fetch_assoc($query);
        if($res1){
       
            echo "invalid";
        }
        else{
            echo "Success";
        }
}


function registration(){
        global $con;
        $fn = mysqli_real_escape_string($con,$_POST['fnReg']);
        $ln = mysqli_real_escape_string($con,$_POST['lnReg']);
        $un = mysqli_real_escape_string($con,$_POST['unReg']);
        $pw = mysqli_real_escape_string($con,$_POST['pwReg']);
        $email = mysqli_real_escape_string($con,$_POST['emailReg']);
        $cn = mysqli_real_escape_string($con,$_POST['cnReg']);
        $dob = mysqli_real_escape_string($con,$_POST['dob']);
        
        $query1 = mysqli_query($con,"INSERT INTO `customer_table`( `first_name`, `last_name`, `user_name`, `pass_word`, `contact_number`, `email_address`, `birthday`) VALUES ('$fn','$ln','$un','$pw','$cn','$email','$dob')")or die(mysqli_error($con));
		
        if($query1){
       // echo "<script>alert('Invalid Credentials!')</script>";
        
       
            $_SESSION["user_name"] = $un; // Initializing Session
            $_SESSION["first_name"] = $fn; // Initializing Session
            $_SESSION["last_name"] = $ln; // Initializing Session
            
            $query = mysqli_query($con,"SELECT `cust_id` FROM customer_table where user_name='".$un."' AND pass_word ='".$pw."' LIMIT 1")or die(mysqli_error($con));
            $res1 = mysqli_fetch_assoc($query);
            if($res1){
           
                $_SESSION["cust_id"] = $res1['cust_id']; // Initializing Session
                header('location: ../index.php');
            }
            
        
        }
        else{
            echo "error to register. please try again. <a href='../index.php'>Click this to back in Calle Preciousa Home page.</a>";
        }
}

function check_availability(){
       
       global $con;
        $e_area = mysqli_real_escape_string($con,$_GET['event_area']);
        $e_date = mysqli_real_escape_string($con,$_GET['event_date']);
        $e_start = mysqli_real_escape_string($con,$_GET['event_start']);
        $e_end = mysqli_real_escape_string($con,$_GET['event_end']);
        
        $query = mysqli_query($con,"SELECT `event_start`,`event_end` FROM `event_info` WHERE `event_area` LIKE '$e_area' AND `event_date` LIKE '$e_date' ")or die(mysqli_error($con));
		$res1 = mysqli_fetch_assoc($query);
        if($res1){
       // echo "<script>alert('Invalid Credentials!')</script>";
            
            if((strtotime($res1['event_start'])<strtotime($e_start))&&(strtotime($res1['event_end'])>strtotime($e_start))){
                 echo "invalid-time1";
            }
            elseif((strtotime($res1['event_start'])<strtotime($e_end))&&(strtotime($res1['event_end'])>strtotime($e_end))){
                echo "invalid-time2";
                
                
            }else{
               $query1 = mysqli_query($con,"SELECT `event_id` FROM `event_info` WHERE  `event_area` LIKE '$e_area' AND `event_date` LIKE '$e_date' AND(`event_start` BETWEEN '$e_start' AND '$e_end' OR `event_end` BETWEEN '$e_start' AND '$e_end')")or die(mysqli_error($con));
                $res2 = mysqli_fetch_assoc($query1);
                if($res2){
            
                    echo "invalid-time3";
                }else{
                    echo "available";
                }
            }
            
           
            
        }
        else{
            echo "available";
        }
}

function insert_reservation(){
    try{
        
        global $con;
            $sql = mysqli_query($con,"SELECT count(`cust_id`) FROM `event_information` WHERE `cust_id` = '".$_SESSION['cust_id']."' ")or die(mysqli_error($con));
            $res1 = mysqli_fetch_array($sql);
                if($res1){

                    $event_system_id = $_SESSION['cust_id']."-".$res1['0'];

                    //event information
                    $typeEvent  = mysqli_real_escape_string($con,$_POST['typeEvent']);
                    $areaEvent  = mysqli_real_escape_string($con,$_POST['areaEvent']);
                    $paxEvent   = mysqli_real_escape_string($con,$_POST['paxEvent']);
                    $repEvent   = mysqli_real_escape_string($con,$_POST['repEvent']);
                    $dateEvent  = mysqli_real_escape_string($con,$_POST['dateEvent']);
                    $startEvent = mysqli_real_escape_string($con,$_POST['startEvent']);
                    $endEvent   = mysqli_real_escape_string($con,$_POST['endEvent']);
                    //package information
                    $typePackage  = mysqli_real_escape_string($con,$_POST['typePackage']);

                    $porkPackage = "";
                    if(isset($_POST['porkPackage'])){
                        $porkPackage = mysqli_real_escape_string($con,$_POST['porkPackage']);
                    }


                    $chickenPackage  = mysqli_real_escape_string($con,$_POST['chickenPackage']);
                    $fishPackage  = mysqli_real_escape_string($con,$_POST['fishPackage']);
                    $vegetablePackage  = mysqli_real_escape_string($con,$_POST['vegetablePackage']);
                    $ricePackage  = mysqli_real_escape_string($con,$_POST['ricePackage']);
                    $icedteaPackage  = mysqli_real_escape_string($con,$_POST['icedteaPackage']);
                    $lemonPackage  = mysqli_real_escape_string($con,$_POST['lemonPackage']);
                    $bukoPackage  = mysqli_real_escape_string($con,$_POST['bukoPackage']);
                    //add services
                    $mobileBar = "";
                    $photobooth = "";
                    $cake = "";
                        $dessert = "";
                        if(isset($_POST['selectedItems1'])){
                            $mobileBar = mysqli_real_escape_string($con,$_POST['selectedItems1']);
                        }
                        if(isset($_POST['selectedItems2'])){
                            $photobooth = mysqli_real_escape_string($con,$_POST['selectedItems2']);
                        }
                        if(isset($_POST['selectedItems3'])){
                            $cake = mysqli_real_escape_string($con,$_POST['selectedItems3']);
                        }
                        if(isset($_POST['selectedItems4'])){
                            $dessert = mysqli_real_escape_string($con,$_POST['selectedItems4']);
                        }

                        //add foods 
                        $addCount = mysqli_real_escape_string($con,$_POST['addCount']);


                        $packagePrice = mysqli_real_escape_string($con,$_POST['cost-package-input']);
                    $packagePerHead = mysqli_real_escape_string($con,$_POST['cost-price-per-head-input']);
                    $total = mysqli_real_escape_string($con,$_POST['cost-total-input']);
                    $addServices = mysqli_real_escape_string($con,$_POST['cost-add-services-input']);
                    $addFood = mysqli_real_escape_string($con,$_POST['cost-add-food-input']);
                    $total = mysqli_real_escape_string($con,$_POST['cost-total-input']);
                    $eventHours = mysqli_real_escape_string($con,$_POST['cost-event-hours-input']);
                    $areaRate = mysqli_real_escape_string($con,$_POST['cost-area-rate-input']);


                    $query1 = "INSERT INTO `event_information`(`event_system_id`, `typeEvent`, `areaEvent`, `paxEvent`, `repEvent`, `dateEvent`, `startEvent`, `endEvent`, `packageCost`, `perheadCost`, `addservicesCost`, `addfoodCost`, `totalCost` , `event_hours`, `area_rate`,`cust_id`,`event_status`) VALUES ('$event_system_id','$typeEvent','$areaEvent','$paxEvent','$repEvent','$dateEvent' ,'$startEvent','$endEvent','$packagePrice','$packagePerHead','$addServices','$addFood','$total','$eventHours','$areaRate','".$_SESSION['cust_id']."','Pending')";

                    $q1= mysqli_query($con, $query1)or die(mysqli_error($con)."1");

                    $query2 = "INSERT INTO `event_package_information`( `packageType`,`porkPackage`, `chickenPackage`, `fishPackage`, `vegetablePackage`, `ricePackage`, `icedteaPackage`, `lemonPackage`, `bukoPackage`, `event_system_id`) VALUES ('$typePackage','$porkPackage', '$chickenPackage', '$fishPackage', '$vegetablePackage', '$ricePackage', '$icedteaPackage', '$lemonPackage',  '$bukoPackage', '$event_system_id')";

                    $q2 = mysqli_query($con, $query2)or die(mysqli_error($con)."2");

                    $af = "";
                    $q3 = true;
                    if($addCount!="0"){
                        for($i = 0 ; $i < $addCount ; $i++){
                            if($i != ($addCount-1) ){
                                $af = $af."( '$event_system_id', '".mysqli_real_escape_string($con,$_POST["addfood".($i+1)])."', '".mysqli_real_escape_string($con,$_POST["addfoodprice".($i+1)])."'),";
                            }else{
                                $af = $af."( '$event_system_id', '". mysqli_real_escape_string($con,$_POST["addfood".($i+1)])."', '".mysqli_real_escape_string($con,$_POST["addfoodprice".($i+1)])."')";
                            }

                        }
                             
                        $query3 = "INSERT INTO `add_food_information`( `event_system_id`, `add_food`,`food_price`) VALUES ".$af;

                        $q3 = mysqli_query($con, $query3)or die(mysqli_error($con) ."3");
                        
                    }
                    
                    

                    $query4 = "INSERT INTO `add_services_information`( `event_system_id`, `add_services`) VALUES ('$event_system_id','$mobileBar') , ('$event_system_id','$photobooth') , ('$event_system_id','$cake') , ('$event_system_id','$dessert')";

                    $q4 = mysqli_query($con, $query4)or die(mysqli_error($con)."4");


                    if(!$q1){
                        echo "error 401-1";
                    }else if(!$q2){
                        echo "error 401-2";
                    }else if(!$q3){
                        echo "error 401-3";
                    }else if(!$q4){
                        echo "error 401-4";
                    }else{
                        header("location:../successReservation.php");
                    }
                
                
            
            }
    }catch(Exception $e) {
      echo 'Message: ' .$e->getMessage();
    }
            
		
            		
       
    
}

function loadMyEvent(){
    global $con;
     
        
        $queryString = "SELECT `event_id`, `event_system_id`, `typeEvent`, `dateEvent` FROM `event_information` WHERE `cust_id` = '".$_SESSION['cust_id']."'";
		
        if($query = mysqli_query($con,$queryString)or die(mysqli_error($con)."4")){
       // echo "<script>alert('Invalid Credentials!')</script>";
            
        while($res1 = mysqli_fetch_assoc($query)){
            ?>
                <a href="#" class="list-group-item cal-events-list" onclick="loadEventInfo('<?php echo $res1['event_id'];?>');">
                    <?php echo $res1['typeEvent']." <br> Date :".$res1['dateEvent']; ?>
                </a>
            <?php
        }
       
            
        }
        else{
            echo "invalid";
        }
}

function loadEventInfo($id){
     global $con;
    
    $id = mysqli_real_escape_string($con,$id);
    $queryString = "SELECT `event_status`,`event_id`, `event_system_id`, `typeEvent`, `areaEvent`, `paxEvent`, `repEvent`, `dateEvent`, `startEvent`, `endEvent`, `packageCost`, `perheadCost`, `addservicesCost`, `addfoodCost`, `totalCost`, `event_hours`, `area_rate`, `cust_id` FROM `event_information` WHERE `event_id` = '$id' ORDER BY `event_id`";
		
            $pax_Event = "";
            $packageCost_Event ="";
            $perheadCost_Event = "";
            $addservicesCost_Event = "";
            $addfoodCost_Event = "";
            $totalCost_Event = "";
            $eventhoursCost_Event = "";
            $arearateCost_Event = "";
        
    
        if($query = mysqli_query($con,$queryString)or die(mysqli_error($con)."0")){
            
       // echo "<script>alert('Invalid Credentials!')</script>";
            try{
                
            
           
                
            while($res = mysqli_fetch_assoc($query)){
                
                
                $id = $res['event_system_id'];
                
                $dateEvent = $res['dateEvent'];
                if(($res['event_status']!="Cancel")&&(strtotime($dateEvent) > strtotime(date("Y-m-d")) ) ){
                    ?>
                        <h1 id="remainingDays" ></h1>
                            <div class="col-lg-6">
                                <a class="btn btn-block btn-success " style="margin-bottom:10px;" onclick="try{updateEvent('<?php echo $res['event_id']; ?>');}catch(err){alert(err.message);}">Update Event</a>
                            </div>
                        <div class="col-lg-6">
                                <a class="btn btn-block btn-danger" style="margin-bottom:10px;"  data-toggle="modal" data-target="#myModalCancel">Cancel Event</a>
                        </div>
                <div class="modal fade" id="myModalCancel" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">

                          <button id="cancel-close" type="button" class="close" data-dismiss="modal" style="color:white !important;" >&times;</button>

                        <div class="modal-body" style="padding:40px 50px;">

                                <center>
                                    <h1 style="font-size:50px;"><span class="glyphicon glyphicon-envelope"></span></h1>
                                    <p>If you cancel this event, it will not be asfd,sld.m
                                    <br>
                                    Wsfsdfzdfsedg
                                    
                                    </p>
                                    <br>
                                    <input type="checkbox" value="agree-in-terms-&-condition" onchange="if(this.checked){document.getElementById('cancel').style.display = 'block';}else{document.getElementById('cancel').style.display = 'none';}"> <label>I agree in <a href="#" style="color:red !important;">terms and condition.</a></label>
                                </center>
                                <a class="btn btn-block btn-danger" style="margin-bottom:10px;  display:none;" id="cancel" onclick="cancelEvent('<?php echo $res['event_id']; ?>');">Cancel Event</a>
                                
                        </div>

                      </div>

                    </div>
                  </div> 
                    <?php
                }else{
                    echo "<h1 id='remainingDays'>Event is done</h1>";
                }
                
                
                $pax_Event = $res['paxEvent'];
                $packageCost_Event = $res['packageCost'];
                $perheadCost_Event = $res['perheadCost'];
                $addservicesCost_Event = $res['addservicesCost'];
                $addfoodCost_Event = $res['addfoodCost'];
                $totalCost_Event = $res['totalCost'];
                $eventhoursCost_Event = $res['event_hours'];
                $arearateCost_Event = $res['area_rate'];
                
                ?>
                    <!--html Code here-->
                            <tr>
                                <th ><h1 class="cal-info-header">Event Information</h1></th>
                                <th ></th>
                            </tr>
                            <tr>
                                <td style="max-width:60%;width:60%;">Event Status</td>
                                <td style="max-width:40%;width:40%;"><?php echo $res['event_status'];?></td>
                              </tr>
                            <tr>
                                <td style="max-width:60%;width:60%;">Type Event</td>
                                <td style="max-width:40%;width:40%;"><?php echo $res['typeEvent'];?></td>
                              </tr>
                              <tr>
                                <td>Venue</td>
                                <td><?php echo $res['areaEvent']; ?></td>

                              </tr>
                              <tr>
                                <td>No. of Pax</td>
                                <td><?php echo $res['paxEvent']; ?></td>
                              </tr>
                                <tr>
                                <td>Event Representative</td>
                                <td><?php echo $res['repEvent']; ?></td>
                              </tr>
                                <tr>
                                <td>Date of Event</td>
                                <td id="dateEvent"><?php echo $dateEvent; ?></td>
                              </tr>
                                <tr>
                                <td>Start Time of Event</td>
                                <td><?php echo $res['startEvent']; ?></td>
                                </tr>
                                <tr>
                                <td>End Time of Event</td>
                                <td><?php echo $res['endEvent']; ?></td>
                                </tr>


                <?php
            }
           
        }catch(Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
            
        }
        else{
            ?>
                        <tr>
                            <th ><h1 class="cal-info-header">Event Information</h1></th>
                            <th ></th>
                        </tr>               
            <?php
        }
    
    
    $queryString1 = "SELECT `event_package_id`, `packageType`, `porkPackage`, `chickenPackage`, `fishPackage`, `vegetablePackage`, `ricePackage`, `icedteaPackage`, `lemonPackage`, `bukoPackage`, `event_system_id` FROM `event_package_information` WHERE `event_system_id` = '".$id."' ORDER BY `event_package_id`";
		
    
        if($query1 = mysqli_query($con,$queryString1)or die(mysqli_error($con)."1")){
       // echo "<script>alert('Invalid Credentials!')</script>";
            while($res1 = mysqli_fetch_assoc($query1)){

                ?>
                    <!--html Code here-->
                            <tr>
                                <th colspan="2" class="cal-info-header"><h1>Package Information</h1></th>
                            </tr>
                            <tr>
                            <td>Package type</td>
                            <td>Package 1</td>

                          </tr>
                        <?php 
                            if($res1['porkPackage']!=""){
                                ?>
                                    <tr>
                                    <td>Pork</td>
                                    <td><?php echo $res1['porkPackage']; ?></td>
                                  </tr>
                        <?php
                            }

                        ?>

                            <tr>
                            <td>Chicken</td>
                            <td><?php echo $res1['chickenPackage']; ?></td>
                          </tr>
                            <tr>
                            <td>Fish</td>
                            <td><?php echo $res1['fishPackage']; ?></td>
                          </tr>
                            <tr>
                            <td>Vegetables</td>
                            <td><?php echo $res1['vegetablePackage']; ?></td>
                          </tr>
                            <tr>
                            <td>Rice</td>
                            <td><?php echo $res1['ricePackage']; ?></td>
                          </tr>
                            </tr>
                            <tr>
                            <td>Iced Tea</td>
                            <td><?php echo $res1['icedteaPackage']; ?></td>
                          </tr>
                    </tr>
                            <tr>
                            <td>Lemon</td>
                            <td><?php echo $res1['lemonPackage']; ?></td>
                          </tr>
                            </tr>
                            <tr>
                            <td>Buko Pandan</td>
                            <td><?php echo $res1['bukoPackage']; ?></td>
                          </tr>


                <?php
            }
       
            
        }
        else{
            ?>
                        <tr>
                            <th ><h1 class="cal-info-header">Package Information</h1></th>
                            <th ></th>
                        </tr>               
            <?php
        }
    
    $queryString2 = "SELECT `add_services_id`, `event_system_id`, `add_services` FROM `add_services_information` WHERE `event_system_id` = '".$id."' ORDER BY `add_services_id`";
		
    
        if($query2 = mysqli_query($con,$queryString2)or die(mysqli_error($con)."2")){
        ?>
                        <tr>
                            <th colspan="2" class="cal-info-header"> <h1 class="cal-info-header">Additional Services</h1></th>
                            
                        </tr>  
        <?php
           
            while($res2 = mysqli_fetch_assoc($query2)){

                
                if(($res2['add_services']=="Mobile Bar")){
                    echo "<tr><td>Mobile Bar</td><td>Yes</td></tr>";
                }else{
                    echo "<tr><td>Mobile Bar</td><td>No</td></tr>";
                } 
                if(($res2['add_services']=="Photobooth")){
                    echo "<tr><td>Photobooth</td><td>Yes</td></tr>";
                }else{
                    echo "<tr><td>Photobooth</td><td>No</td></tr>";
                } 
                if(($res2['add_services']=="Cake")){
                    echo "<tr><td>Cake</td><td>Yes</td></tr>";
                }else{
                    echo "<tr><td>Cake</td><td>No</td></tr>";
                } 
                if(($res2['add_services']=="Dessert Buffet")){
                    echo "<tr><td>Dessert Buffet</td><td>Yes</td></tr>";
                }else{
                    echo "<tr><td>Dessert Buffet</td><td>No</td></tr>";
                }
                break;  
                
            }
       
            
        }
        else{
            ?>
                        <tr>
                            <th colspan="2" class="cal-info-header"> <h1 class="cal-info-header">Additional Services</h1></th>
                            
                        </tr>               
            <?php
        }
    $queryString3 = "SELECT `add_food_id`, `event_system_id`, `add_food` FROM `add_food_information` WHERE `event_system_id` = '".$id."' ORDER BY `add_food_id`";
		
    
        if($query3 = mysqli_query($con,$queryString3)or die(mysqli_error($con)."3")){
        ?>
                        <tr>
                            <th colspan="2" class="cal-info-header"> <h1 class="cal-info-header">Additional Food</h1></th>
                            
                        </tr>  
        <?php
            while($res3 = mysqli_fetch_assoc($query3)){

                ?>
                    <!--html Code here-->
                        <tr>
                            <th colspan="2"><?php echo $res3['add_food']; ?></th>
                        </tr>

                <?php
            }
       
            
        }
        else{
            ?>
                        <tr>
                            <th colspan="2" class="cal-info-header"> <h1 class="cal-info-header">Additional Food</h1></th>
                            
                        </tr>               
            <?php
        }  
    
        ?>
            

                        <tr>
                            <th colspan="2"><h1>Cost of Event</h1></th>
                        </tr>
                        <tr>
                            <td>No. of Pax</td>
                            <td><?php echo $pax_Event; ?></td>
                        </tr>
                        <tr>
                            <td>Venue Rate per hr.</td>
                            <td><?php echo $arearateCost_Event; ?></td>
                        </tr>
                        <tr>
                            <td>Total of hrs. of Event</td>
                            <td><?php echo $eventhoursCost_Event; ?></td>
                        </tr>
                        <tr>
                            <td>Venue Amount</td>
                            <td >
                                <?php
                                    $a = $arearateCost_Event;
                                    $b = $eventhoursCost_Event;
                        
                                    $c = str_split($b,1);
                                    $d = $c[0]."".$c[1];
                                    $e = $c[3]."".$c[4];
                                    
    
                                    $f = ($d * $arearateCost_Event) + (($e / 60 )* $arearateCost_Event);
                                    echo $f;
                                ?>
                            </td>
                            
                        </tr>
                                
                        <tr>
                            <td>Package Amount</td>
                            <td><?php echo $packageCost_Event; ?></td>
                        </tr>
                        <tr>
                            <td>Package price per head</td>
                            <td><?php echo $perheadCost_Event; ?></td>
                        </tr>
                        <tr>
                            <td>Additional Services</td>
                            <td><?php echo $addservicesCost_Event; ?></td>
                        </tr>
                        <tr>
                            <td>Additional Food</td>
                            <td><?php echo $addfoodCost_Event; ?></td>
                        </tr>
                        <tr>
                            <td><strong><h2>Total</h2></strong></td>
                            <td><h2><?php echo $totalCost_Event; ?></h2></td>
                        </tr>

        <?php
    
    
}

function cancelEvent($id){
    global $con;
     
        
        $queryString = " UPDATE `event_information` SET `event_status`='Cancel' WHERE `event_id` = '$id'";
		
        if($query = mysqli_query($con,$queryString)or die(mysqli_error($con))){
       // echo "<script>alert('Invalid Credentials!')</script>";
            
            echo "Success";
       
            
        }
        else{
            echo "invalid";
        }
}


function update_reservation(){
    
}

?>
