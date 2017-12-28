<?php
require_once 'connect.php';
if(isset($_GET['setAsHoliday'])){
    
    setAsHoliday(mysqli_real_escape_string($con, $_GET['setAsHoliday']));
}else if(isset($_GET['addFoodName'])){
    
    addFood(mysqli_real_escape_string($con, $_GET['addFoodName']), mysqli_real_escape_string($con, $_GET['addFoodPrice']));
}else if(isset($_GET['editAddFoodName'])){
    
    editAddFood(mysqli_real_escape_string($con, $_GET['editAddFoodName']), mysqli_real_escape_string($con, $_GET['editAddFoodPrice']),  mysqli_real_escape_string($con, $_GET['editAddFoodId']));
    
}else if(isset($_GET['deleteAddFoodId'])){
    
    deleteAddFood(mysqli_real_escape_string($con, $_GET['deleteAddFoodId']));
}else if(isset($_GET['loadPendingReservation'])){
    
    loadPendingReservation();
}else if(isset($_GET['loadAddFood'])){
    
    loadAddFood();
}else if(isset($_GET['viewEvent'])){
    viewEvent(mysqli_real_escape_string($con, $_GET['viewEvent']));
}else if(isset($_GET['acceptReservation'])){
    acceptReservation(mysqli_real_escape_string($con, $_GET['acceptReservation']));
}else if(isset($_GET['cancelReservation'])){
    cancelReservation(mysqli_real_escape_string($con, $_GET['cancelReservation']));
}else if(isset($_GET['paymentReservationId'])){
   paymentReservation(mysqli_real_escape_string($con, $_GET['paymentReservationId']),mysqli_real_escape_string($con, $_GET['paymentReservationPCA']),mysqli_real_escape_string($con, $_GET['paymentReservationPA']));
}else if(isset($_GET['loadReserveEvent'])){
   loadReserveEvent();
}else if(isset($_GET['loadPayment'])){
   loadPaymentEvent($_GET['loadPayment']);  
}else if(isset($_GET['approvePayment_payment2_id'])){
   approvePayment($_GET['approvePayment_payment_id'],$_GET['approvePayment_payment2_id']);  
}else if(isset($_GET['disapprovePayment_payment2_id'])){
   disapprovePayment($_GET['disapprovePayment_payment_id'],$_GET['disapprovePayment_payment2_id']);  
}else{
    echo "error 404";
}
function setAsHoliday($date){
    global $con ;
    $query = mysqli_query($con,"INSERT INTO `holiday`( `holiday_day`, `holiday_status`) VALUES ('$date','active')")or die(mysqli_error($con));
		
        if($query){
            echo "success";
        }
        else{
            echo "invalid";
        }
}

function addFood($name,$price){
    global $con ;
    $query = mysqli_query($con,"INSERT INTO `additional_food_table`( `additional_food_name`, `additional_food_price`, `additional_food_status`) VALUES ('$name','$price','active')")or die(mysqli_error($con));
		
        if($query){
            echo "success";
        }
        else{
            echo "invalid";
        }
}
function editAddFood($name,$price,$id){
    global $con ;
    $query = mysqli_query($con,"UPDATE `additional_food_table` SET `additional_food_name`='$name',`additional_food_price`='$price'  WHERE `additional_food` = '$id' ")or die(mysqli_error($con));
    if($query){
            echo "success";
        }
        else{
            echo "invalid";
        }
}

function  deleteAddFood($id){
    global $con ;
    $query = mysqli_query($con,"UPDATE `additional_food_table` SET `additional_food_status`='deleted'  WHERE `additional_food` = '$id' ")or die(mysqli_error($con));
    if($query){
            echo "success";
        }
        else{
            echo "invalid";
        }
}
function loadAddFood(){
    global $con ;
     $sql = mysqli_query($con,"SELECT  `additional_food`,`additional_food_name`, `additional_food_price` FROM `additional_food_table` WHERE `additional_food_status` = 'active' ORDER BY `additional_food_name`")or die(mysqli_error($con));
                                        
       while($res1 = mysqli_fetch_array($sql)){
       ?><tr>
            <td><?php echo $res1[1];?></td>
            <td><?php echo $res1[2];?></td>
            <td>
                <div class="row">
                    <div class="col-md-6">
                        <a class="btn btn-primary btn-block" onclick="try{editAddFood('<?php echo $res1[1];?>','<?php echo $res1[2];?>' ,'<?php echo $res1[0];?>');}catch(err){alert(err);}">Edit</a>
                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-danger btn-block" onclick="try{deleteAddFood('<?php echo $res1[0];?>','<?php echo $res1[1];?>' );}catch(err){alert(err);}" >Delete</a>
                    </div>
                </div>
                
                
            </td>
        </tr>
        
                                            <?php
                                        }
                                     
                                  
}

function loadPendingReservation(){
                    
                    global $con ;
                   $date = date_create(date("Y-m-d"));
                    $sql = mysqli_query($con,"SELECT  `event_id`,`typeEvent`, `areaEvent` , `dateEvent` ,`event_hours`,`event_status`, `event_id`,`customer_table`.`first_name`,`customer_table`.`last_name`,`event_information`.`cust_id` FROM `event_information` LEFT JOIN `customer_table` ON `event_information`.`cust_id` = `customer_table`.`cust_id` WHERE `event_status` = 'Pending' ORDER BY event_information.dateEvent ")or die(mysqli_error($con));
                    
                    $eventThisMonth = array();
                    $i=0;
                    while($res1 = mysqli_fetch_array($sql)){
                        $ii=0;
                        $eventThisMonth[$i][$ii] = $res1['typeEvent'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['areaEvent'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = ucwords($res1['last_name']).", ".ucwords($res1['first_name']);
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['dateEvent'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['event_hours'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['event_status'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['event_id'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['cust_id'];
                       
                        $i++;
                        }
                    
                ?>
                       
                <div class="row" >
                   
                </div>
                <div class="row">
                    <!-- progress report -->
                    <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-striped">
                            <thead >
                              <tr >
                                <th style="font-weight:900 !important;">Event Type</th>
                                <th style="font-weight:900 !important;">Area</th>
                                <th style="font-weight:900 !important;">Customer Name</th>
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
                                    ?>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a class="btn btn-primary btn-block" onclick="try{viewPendingReservation('<?php echo $eventThisMonth[$i][6];?>');}catch(err){alert(err);}">View</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a class="btn btn-block btn-danger" style="margin-bottom:10px;"  data-toggle="modal" data-target="#myModalCancel" onclick="document.getElementById('cancelEventId').value = '<?php echo $eventThisMonth[$i][6]; ?>';">Cancel Event</a>
                                        </div>
                                    </div>


                                </td>
                                    <?php
                                    echo "</tr>";
                                }
                                
                                ?>
                                
                            </tbody>
                          </table>
                    </div>
           
      
                </div>
<?php
}

function loadReserveEvent(){
                    
                    global $con ;
                   $date = date_create(date("Y-m-d"));
                    $sql = mysqli_query($con,"SELECT  `event_id`,`typeEvent`, `areaEvent` , `dateEvent` ,`event_hours`,`event_status`, `event_id`,`customer_table`.`first_name`,`customer_table`.`last_name`,`event_information`.`cust_id` FROM `event_information` LEFT JOIN `customer_table` ON `event_information`.`cust_id` = `customer_table`.`cust_id` WHERE `event_status` = 'Reserve' ORDER BY event_information.dateEvent ")or die(mysqli_error($con));
                    
                    $eventThisMonth = array();
                    $i=0;
                    while($res1 = mysqli_fetch_array($sql)){
                        $ii=0;
                        $eventThisMonth[$i][$ii] = $res1['typeEvent'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['areaEvent'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = ucwords($res1['last_name']).", ".ucwords($res1['first_name']);
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['dateEvent'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['event_hours'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['event_status'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['event_id'];
                        $ii++;
                        $eventThisMonth[$i][$ii] = $res1['cust_id'];
                       
                        $i++;
                        }
                    
                ?>
                       
                <div class="row" >
                   
                </div>
                <div class="row">
                    <!-- progress report -->
                    <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-striped">
                            <thead >
                              <tr >
                                <th style="font-weight:900 !important;">Event Type</th>
                                <th style="font-weight:900 !important;">Area</th>
                                <th style="font-weight:900 !important;">Customer Name</th>
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
                                    ?>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a class="btn btn-primary btn-block" onclick="try{viewEvent('<?php echo $eventThisMonth[$i][6];?>');}catch(err){alert(err);}">View</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a class="btn btn-danger btn-block" onclick="try{cancelPendingReservation('<?php echo $eventThisMonth[$i][6];?>','<?php echo $eventThisMonth[$i][7];?>' );}catch(err){alert(err);}" >Cancel </a>
                                        </div>
                                    </div>


                                </td>
                                    <?php
                                    echo "</tr>";
                                }
                                
                                ?>
                                
                            </tbody>
                          </table>
                    </div>
           
      
                </div>
<?php
}

function viewEvent($id){
     global $con;
    
    $id = mysqli_real_escape_string($con,$id);
    
    $queryString = "SELECT `event_status`,`event_id`, `event_system_id`, `typeEvent`, `areaEvent`, `paxEvent`, `repEvent`, `dateEvent`, `startEvent`, `endEvent`, `packageCost`, `perheadCost`, `addservicesCost`, `addfoodCost`, `totalCost`, `event_hours`, `area_rate`, `cust_id` ,`payment_status` FROM `event_information` WHERE `event_id` = '$id' ORDER BY `event_id`";
		
            $pax_Event = "";
            $packageCost_Event ="";
            $perheadCost_Event = "";
            $addservicesCost_Event = "";
            $addfoodCost_Event = "";
            $totalCost_Event = "";
            $eventhoursCost_Event = "";
            $arearateCost_Event = "";
            $cust_id="";
    
            $event_id="";
            $event_system_id="";
            
        if($query = mysqli_query($con,$queryString)or die(mysqli_error($con)."0")){
            
       // echo "<script>alert('Invalid Credentials!')</script>";
            try{
                
            
           
                
            while($res = mysqli_fetch_assoc($query)){
                
                $cust_id=$res['cust_id'];
                $id = $res['event_system_id'];
                $event_id = $res['event_id'];
                $event_system_id = $res['event_system_id'];
                $dateEvent = $res['dateEvent'];
                $event_status = $res['event_status'];
                
                
                if(($event_status!="Cancel")&&(strtotime($dateEvent) > strtotime(date("Y-m-d")) ) ){
                    ?>
                   
                        <h1 id="remainingDays" ></h1>
                        <tr>
                           <td colspan="2">
                               <?php if($event_status=="Pending"){
                                ?>
                               <div class="col-lg-4" > 
                                <a class="btn btn-block btn-primary " style="margin-bottom:10px;"   data-toggle="modal" data-target="#myModalAccept" onclick="document.getElementById('acceptEventId').value = '<?php echo $event_id; ?>';" >Accept</a>
                                </div>
                                <?php } ?>
                                
                               <?php if($event_status=="Reserve"){
                                ?>
                               <div class="col-lg-4">
                                        <a class="btn btn-block btn-success"  onclick="loadPaymentEvent('<?php echo $event_system_id;?>')">Payment</a>
                               </div>
                                <?php } ?>
                                
                                <div class="col-lg-4">
                                        <a class="btn btn-block btn-danger" style="margin-bottom:10px;"  data-toggle="modal" data-target="#myModalCancel" onclick="document.getElementById('cancelEventId').value = '<?php echo $event_id; ?>';">Cancel Event</a>
                                </div>       
                            </td>
                        </tr>
                            
                        
                                
                 
            
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
                                <tr>
                                    <td>Payment_status</td>
                                    <td><?php echo $res['payment_status']; ?></td>
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
                $queryString4 = "SELECT `payment_id` ,`contract_payment`, `payment`, `payment_status` FROM `payment_table` WHERE `event_id` = '$id'";
		
    
        if($query4 = mysqli_query($con,$queryString4)or die(mysqli_error($con)."4")){
        ?>
                       
                         
        <?php
            if($res4 = mysqli_fetch_assoc($query4)){

                ?>
                    <!--html Code here-->
                        <tr>
                            <th colspan="2" class="cal-info-header"> <h1 class="cal-info-header">Payment Information</h1></th>
                            
                        </tr> 
                        <tr>
                            <td>Contract Payment</td>
                            <td id="ct-p"><?php echo $res4['contract_payment']; ?></td>
                        </tr>
                        <tr>
                            <td>Paid</td>
                            <td><?php echo $res4['payment']; ?></td
                        </tr>
                        <tr>
                            <td><strong><h2>Balance</h2></strong></td>
                            <td><h2><?php echo ($res4['contract_payment'] -  $res4['payment']);  ?></h2></td>
                        </tr>        

                <?php
            }else{
                ?>       <hr>
                        <tr>
                            <th colspan="2" class="cal-info-header"> <h1 class="cal-info-header">Payment Information</h1></th>
                            
                        </tr>  
                        
                        <tr>
                            <td>Contract Payment</td>
                            <td id="ct-p"><?php echo $totalCost_Event; ?></td>
                        </tr>
                        <tr>
                            <td>Paid</td>
                            <td>0</td
                        </tr>
                        
                        <tr>
                            <td><strong><h2>Balance</h2></strong></td>
                            <td><h2><?php echo $totalCost_Event; ?></h2></td>
                        </tr>
            <?php
            }
            
            
        }
        else{
            ?>           <hr>
                        <tr>
                            <th colspan="2" class="cal-info-header"> <h1 class="cal-info-header">Payment Information</h1></th>
                            
                        </tr>  
                        
                        <tr>
                            <td>Contract Payment</td>
                            <td id="ct-p"><?php echo $totalCost_Event; ?></td>
                        </tr>
                        <tr>
                            <td>Paid</td>
                            <td>0</td
                        </tr>
                        
                        <tr>
                            <td><strong><h2>Balance</h2></strong></td>
                            <td><h2><?php echo $totalCost_Event; ?></h2></td>
                        </tr>
            <?php
        }  
    
       
                $queryString5 = "SELECT  `first_name`, `last_name`, `user_name`, `contact_number`, `email_address` FROM `customer_table` WHERE `cust_id` = '$cust_id'";
		
    
        if($query5 = mysqli_query($con,$queryString5)or die(mysqli_error($con)."5")){
       
            if($res5 = mysqli_fetch_assoc($query5)){

                ?>
                    <!--html Code here-->
                        <tr>
                            <th colspan="2" class="cal-info-header"> <h1 class="cal-info-header">Customer Information</h1></th>
                            
                        </tr> 
                        <tr>
                            <td>Name</td>
                            <td><?php echo ucwords($res5['last_name']).", ".ucwords($res5['first_name']); ?></td
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td><?php echo $res5['user_name']; ?></td
                        </tr>
                        <tr>
                            <td>Contact Number</td>
                            <td><?php echo $res5['contact_number']; ?></td
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $res5['email_address']; ?></td
                        </tr>
                             

                <?php
            }
        }
        
        ?>
                <tr><td colspan=2><br></td></tr>
                <tr>
                    
                            <td colspan="2">
                                
                                 <?php if($event_status=="Pending"){
                                ?>
                               <div class="col-lg-4" > 
                                <a class="btn btn-block btn-primary " style="margin-bottom:10px;"   data-toggle="modal" data-target="#myModalAccept" onclick="document.getElementById('acceptEventId').value = '<?php echo $event_id; ?>';" >Accept</a>
                                </div>
                                <?php } ?>
                                <?php if($event_status=="Reserve"){
                                ?>
                               <div class="col-lg-4">
                                        <a class="btn btn-block btn-success"  onclick="loadPaymentEvent('<?php echo $event_system_id;?>')">Payment</a>
                               </div>
                                <?php } ?>
                                <div class="col-lg-4">
                                        <a class="btn btn-block btn-danger" style="margin-bottom:10px;"  data-toggle="modal" data-target="#myModalCancel" onclick="document.getElementById('cancelEventId').value = '<?php echo $event_id; ?>';">Cancel Event</a>
                                </div>       
                            </td>
                        </tr>
                            
                        
                                
                
        <?php
            

                       
    
}


function acceptReservation($id){
     global $con ;
        $query = mysqli_query($con,"UPDATE `event_information` SET `event_status`='Reserve' WHERE `event_id` = '$id' ")or die(mysqli_error($con));
    if($query){
            echo "success";
        }
        else{
            echo "invalid";
        }
}
function cancelReservation($id){
     global $con ;
        $query = mysqli_query($con,"UPDATE `event_information` SET `event_status`='Cancel-Admin' WHERE `event_id` = '$id' ")or die(mysqli_error($con));
        if($query){
            echo "success";
        }
        else{
            echo "invalid";
        }
}

function paymentReservation($id,$pca,$pa){
     global $con ;
        $queryString = "SELECT `payment_id` FROM `payment_table` WHERE `event_id` = '$id' ";
		
    
        if($query = mysqli_query($con,$queryString)or die(mysqli_error($con))){
       
            if($res = mysqli_fetch_assoc($query)){
                
                $query1 = mysqli_query($con,"UPDATE `payment_table` SET `contract_payment`='$pca', `payment`='$pa' WHERE `event_id` = '$id' ")or die(mysqli_error($con));
                if($query1){
                    echo "success";
                }
                else{
                    echo "invalid";
                }
                
            }else{
                $query1 = mysqli_query($con,"INSERT INTO `payment_table`(`event_id`, `contract_payment`, `payment`, `payment_status`) VALUES ('$id','$pca','$pa','active') ")or die(mysqli_error($con));
                
                
                if($query1){
                   $query = mysqli_query($con,"UPDATE `event_information` SET `event_status`='Reserve' WHERE `event_system_id` = '$id' ")or die(mysqli_error($con));
                    
                    if($query1){
                    echo "success";
                    }
                    else{
                        echo "invalid";
                    }
                    
                }
                else{
                    echo "invalid";
                }
            }
        }else{
                    echo "invalid";
                }
        
}

function  loadPaymentEvent($id){
    global $con;
    $query = mysqli_query($con,"SELECT `payment_id`, `contract_payment` FROM `payment_table` WHERE `event_id` = '$id'")or die(mysqli_error($con));
		
    $payment_id = "";
    $c_payment = 0;
    $totalpayment = 0;
    while($res = mysqli_fetch_array($query)){
        $payment_id = $res[0];
        $c_payment = $res[1];
        
        ?>
                                <tbody>
                                    <tr>
                                        <td colspan="3"><h3><?php echo "Contract Payment : ".$c_payment;?></h3></td>
                                    </tr>
                                
                                
        <?php
        
        $query1 = mysqli_query($con,"SELECT `payment2_id` ,`payment`, `proof_of_payment`, `status` , `date_submit` FROM `payment2_table` WHERE `payment_id` = '$payment_id'")or die(mysqli_error($con));
		
        $i=1;
        while($res1 = mysqli_fetch_array($query1)){
            $payment = $res1[1];
            
            $status = $res1[3];
            $proof = $res1[2];
            $date = $res1[4];
            $payment2_id = $res1[0];
            if($status =='approved'){
                $totalpayment += $payment;
            }
            
            
            ?>
                                    <tr>
                                        <td><h5>Payment <?php echo $i." : ".$payment." - ".$status; ?> </h5> <a href="#proofOfBilling<?php echo $i; ?>" class="" data-toggle="collapse">Proof of Billing</a></td>
                                        
                                        <td><?php echo $date; ?> asda</td>
                                        <td>
                                            <?php
                                                if(($status=='pending')||($status=='disapproved')){
                                                    ?>
                                                        <a class="btn btn-block btn-primary " style="margin-bottom:10px;"    onclick="if (confirm('Are you sure to approve it?!') == true){approvePayment('<?php echo $payment2_id;?>','<?php echo $payment_id;?>');}" >Approve</a>
                                                    <?php
                                                }
                                            ?>
                                            <a class="btn btn-block btn-danger " style="margin-bottom:10px;"   onclick="try{if (confirm('Are you sure to disapprove it?!' ) == true){disapprovePayment('<?php echo $payment2_id;?>','<?php echo $payment_id;?>');}}catch(err){alert(err.message);}" >Disapprove</a>
                                        </td>
                                    
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div id="proofOfBilling<?php echo $i;?>" class="collapse">
                                                <img id="proofOfBillingImg" src="data:image/png;base64,<?php echo base64_encode($proof);?>" style="vertical-align: middle;" style="width:100%;">
                                            </div>
                                        </td>
                                    </tr>
            <?php
            $i++;
        }
                
        
        ?>
                                    <tr>
                                        <th colspan="3"><h3>Balance <?php echo " : ".($c_payment - $totalpayment);?></h3></th>
                                    </tr>
                                </tbody>
        <?php
    }
       
}

function approvePayment($id1,$id2){
    
    global $con;
    
    $query11 = mysqli_query($con,"UPDATE `payment2_table` SET `status`='approved' WHERE `payment2_id` = '$id2' ")or die(mysqli_error($con));
                    
    if($query11){
    
    
        $query = mysqli_query($con,"SELECT `payment_id`, `contract_payment` FROM `payment_table` WHERE `payment_id` = '$id1'")or die(mysqli_error($con));

        $payment_id = "";
        $c_payment = 0;
        $totalpayment = 0;
        while($res = mysqli_fetch_array($query)){
            $payment_id = $res[0];
            $c_payment = $res[1];

            ?>
                                    <tbody>
                                        <tr>
                                            <td colspan="3"><h3><?php echo "Contract Payment : ".$c_payment;?></h3></td>
                                        </tr>


            <?php

            $query1 = mysqli_query($con,"SELECT `payment2_id` ,`payment`, `proof_of_payment`, `status` , `date_submit` FROM `payment2_table` WHERE `payment_id` = '$payment_id'")or die(mysqli_error($con));

            $i=1;
            while($res1 = mysqli_fetch_array($query1)){
                $payment = $res1[1];

                $status = $res1[3];
                $proof = $res1[2];
                $date = $res1[4];
                $payment2_id = $res1[0];
                if($status =='approved'){
                    $totalpayment += $payment;
                }


                ?>
                                        <tr>
                                            <td><h5>Payment <?php echo $i." : ".$payment." - ".$status; ?> </h5> <a href="#proofOfBilling<?php echo $i; ?>" class="" data-toggle="collapse">Proof of Billing</a></td>

                                            <td><?php echo $date; ?> asda</td>
                                            <td>
                                                <?php
                                                    if(($status=='pending')||($status=='disapproved')){
                                                        ?>
                                                            <a class="btn btn-block btn-primary " style="margin-bottom:10px;"   data- onclick="approvePayment('<?php echo $payment2_id;?>','<?php echo $payment_id;?>');" >Approve</a>
                                                        <?php
                                                    }
                                                ?>
                                                <a class="btn btn-block btn-danger " style="margin-bottom:10px;"   data- onclick="disapprovePayment('<?php echo $payment2_id;?>','<?php echo $payment_id;?>');" >Disapprove</a>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div id="proofOfBilling<?php echo $i;?>" class="collapse">
                                                    <img id="proofOfBillingImg" src="data:image/png;base64,<?php echo base64_encode($proof);?>" style="vertical-align: middle;" style="width:100%;">
                                                </div>
                                            </td>
                                        </tr>
                <?php
                $i++;
            }


            ?>
                                        <tr>
                                            <th colspan="3"><h3>Balance <?php echo " : ".($c_payment - $totalpayment);?></h3></th>
                                        </tr>
                                    </tbody>
            <?php
        }
    }
}
function disapprovePayment($id1,$id2){
    
    global $con;
    
    $query11 = mysqli_query($con,"UPDATE `payment2_table` SET `status`='disapproved' WHERE `payment2_id` = '$id2' ")or die(mysqli_error($con));
                    
    if($query11){
    
    
        $query = mysqli_query($con,"SELECT `payment_id`, `contract_payment` FROM `payment_table` WHERE `payment_id` = '$id1'")or die(mysqli_error($con));

        $payment_id = "";
        $c_payment = 0;
        $totalpayment = 0;
        while($res = mysqli_fetch_array($query)){
            $payment_id = $res[0];
            $c_payment = $res[1];

            ?>
                                    <tbody>
                                        <tr>
                                            <td colspan="3"><h3><?php echo "Contract Payment : ".$c_payment;?></h3></td>
                                        </tr>


            <?php

            $query1 = mysqli_query($con,"SELECT `payment2_id` ,`payment`, `proof_of_payment`, `status` , `date_submit` FROM `payment2_table` WHERE `payment_id` = '$payment_id'")or die(mysqli_error($con));

            $i=1;
            while($res1 = mysqli_fetch_array($query1)){
                $payment = $res1[1];

                $status = $res1[3];
                $proof = $res1[2];
                $date = $res1[4];
                $payment2_id = $res1[0];
                if($status =='approved'){
                    $totalpayment += $payment;
                }


                ?>
                                        <tr>
                                            <td><h5>Payment <?php echo $i." : ".$payment." - ".$status; ?> </h5> <a href="#proofOfBilling<?php echo $i; ?>" class="" data-toggle="collapse">Proof of Billing</a></td>

                                            <td><?php echo $date; ?> asda</td>
                                            <td>
                                                <?php
                                                    if(($status=='pending')||($status=='disapproved')){
                                                        ?>
                                                            <a class="btn btn-block btn-primary " style="margin-bottom:10px;"   data- onclick="approvePayment('<?php echo $payment2_id;?>','<?php echo $payment_id;?>');" >Approve</a>
                                                        <?php
                                                    }
                                                ?>
                                                <a class="btn btn-block btn-danger " style="margin-bottom:10px;"   data- onclick="disapprovePayment('<?php echo $payment2_id;?>','<?php echo $payment_id;?>');" >Disapprove</a>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div id="proofOfBilling<?php echo $i;?>" class="collapse">
                                                    <img id="proofOfBillingImg" src="data:image/png;base64,<?php echo base64_encode($proof);?>" style="vertical-align: middle;" style="width:100%;">
                                                </div>
                                            </td>
                                        </tr>
                <?php
                $i++;
            }


            ?>
                                        <tr>
                                            <th colspan="3"><h3>Balance <?php echo " : ".($c_payment - $totalpayment);?></h3></th>
                                        </tr>
                                    </tbody>
            <?php
        }
    }
}
    ?>