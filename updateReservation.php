<?php

    if(isset($_GET['eventId'])){
    $con = mysqli_connect("localhost","root","","c-preciosa");   

        $id = mysqli_real_escape_string($con,$_GET['eventId']);
        $queryString = "SELECT `event_status`,`event_id`, `event_system_id`, `typeEvent`, `areaEvent`, `paxEvent`, `repEvent`, `dateEvent`, `startEvent`, `endEvent`, `packageCost`, `perheadCost`, `addservicesCost`, `addfoodCost`, `totalCost`, `event_hours`, `area_rate`, `cust_id` FROM `event_information` WHERE `event_id` = '".$id."' ORDER BY `event_id`";

                $pax_Event = "0";
                $packageCost_Event ="0";
                $perheadCost_Event = "0";
                $addservicesCost_Event = "0";
                $addfoodCost_Event = "0";
                $totalCost_Event = "0";
                $eventhoursCost_Event = "0";
                $arearateCost_Event = "0";
                $packageType_Event = "";


            if($query = mysqli_query($con,$queryString)or die(mysqli_error($con)."0")){
                
                $res = mysqli_fetch_assoc($query);
                $id = $res['event_system_id'];
                $pax_Event = $res['paxEvent'];
                $packageCost_Event = $res['packageCost'];
                $perheadCost_Event = $res['perheadCost'];
                $addservicesCost_Event = $res['addservicesCost'];
                $addfoodCost_Event = $res['addfoodCost'];
                $totalCost_Event = $res['totalCost'];
                $eventhoursCost_Event = $res['event_hours'];
                $arearateCost_Event = $res['area_rate'];
            
        ?>



        <div class="row">
             <form method="post" action="f/function.php">
               
                <div class="col-md-12"  style="background-color:rgb(255, 255, 255);" >
                    
                    <div id="event-info">
                        <h1>Event Information</h1>
                        <hr></hr>
                        <p id="warning-1"style="font-weight:100; background:#ffb3b3 !important;padding:10px 5px 10px 5px; border-radius:5px; display:none;"> <span class="glyphicon glyphicon-warning-sign"></span>  We cannot check your event information, some input are wrong.</p>
                         <div class="form-group">
                          <label for="sel1">Type of event:</label>
                          <select class="form-control" id="typeEvent" name="typeEvent">
                              <option><?php echo $res['typeEvent']?></option>
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
                              <option><?php echo $res['areaEvent']?></option>
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
                          <input type="text" class="form-control" id="areaRate" name="areaRate" value="" disabled>
                        </div>
                        <div class="form-group">
                          <label for="usr">No. of Pax:</label>
                          <input type="number" class="form-control" id="paxEvent" name="paxEvent" min="1"  max="30" onchange="document.getElementById('cost-no-of-pax').innerHTML = this.value;" value="<?php echo $res['paxEvent']?>">
                        </div>
                        <div class="form-group">
                          <label for="usr">Event Representative:</label>
                          <input type="text" class="form-control" id="repEvent" name="repEvent" value="<?php echo $res['repEvent']?>" >
                        </div>
                        <div class="form-group">
                          <label for="usr">Date of Event:</label>
                          <input type="date" class="form-control" id="dateEvent" name="dateEvent" onload="try{dateSetMax(this);}catch(err){alert(err.message);}" value="<?php echo $res['dateEvent']?>">
                        </div>
                        <div class="form-group">
                          <label for="usr">Time start:</label>
                          <input type="time" class="form-control" id="startEvent" name="startEvent" min="06:00" max="23:00" value="<?php echo $res['startEvent']?>">
                        </div>
                        <div class="form-group">
                          <label for="usr">Time end:</label>
                          <input type="time" class="form-control" id="endEvent" name="endEvent" min="06:00" max="23:00" value="<?php echo $res['endEvent']?>">
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
                    
                <?php    }
        
         $queryString1 = "SELECT `event_package_id`, `packageType`, `porkPackage`, `chickenPackage`, `fishPackage`, `vegetablePackage`, `ricePackage`, `icedteaPackage`, `lemonPackage`, `bukoPackage`, `event_system_id` FROM `event_package_information` WHERE `event_system_id` = '".$id."' ORDER BY `event_package_id`";
        
           if($query1 = mysqli_query($con,$queryString1)or die(mysqli_error($con)."1")){
       
                while($res1 = mysqli_fetch_assoc($query1)){

                    if($res1['packageType']=="Package 1"){
                        $packageType_Event = "Package 1";
                        ?>
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
                        <?php    
                    }else if($res1['packageType']=="Package 2"){
                        $packageType_Event = "Package 2";
                         ?>
                        <div class="col-xs-6">
                             <div class="radio">
                                <label class="radio" style="font-weight:900" ><input id="typePackage1" type="radio"  name="typePackage" value="Package 1" onchange="packageSelect(this);packagePrice(this);" >  Package 1</label>
                            </div>
                        </div >
                            <div class="col-xs-6">
                                 <div class="radio">
                                    <label class="radio " style="font-weight:900"><input type="radio"  name="typePackage" value="Package 2" onchange="packageSelect(this);packagePrice(this);" checked>  Package 2</label>
                                </div>
                            </div>
                        
                            <div id="packageLaman">
                                <div class="form-group">
                                  <label for="sel1"  >Pork:</label>
                                  <select class="form-control" name="porkPackage">
                                      <option   >
                                       <?php echo $res1  ['porkPackage'];?></option>
                                    <option value = "Pork1"  >
                                       1</option>
                                    <option value = "Pork2">
                                        2</option>
                                    <option value="Pork3">
                                        3</option>
                                    <option value="Pork4">
                                        4</option>
                                    <option value="Pork5">
                                        5</option>

                                  </select>
                                </div>
                        <?php    
                    }


                   
                    ?>
                    
                            
                                <div class="form-group">
                                  <label for="sel1"  >Chicken:</label>
                                  <select class="form-control"  name="chickenPackage" >
                                    <option ><?php echo $res1['chickenPackage'];?></option> 
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
                                      <option ><?php echo $res1['fishPackage'];?></option> 
                                    <option value = "Fish Fillet"  >
                                       Fish Fillet</option>
                                    <option value = "Tahong">
                                        Tahong</option>

                                  </select>
                                </div>
                               <div class="form-group">
                                  <label for="sel1"  >Chopsuey / Pakbet:</label>
                                  <select class="form-control" name="vegetablePackage">
                                      <option ><?php echo $res1['vegetablePackage'];?></option> 
                                    <option value = "Chopsuey"  >
                                       Chopsuey</option>
                                    <option value = "Pakbet">
                                        Pakbet</option>

                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="sel1"  >Rice :</label>
                                  <select class="form-control" name="ricePackage">
                                      <option ><?php echo $res1['ricePackage'];?></option> 
                                    <option value = "Steamed Rice"  >
                                       Steamed Rice</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="sel1"  >Iced Tea:</label>
                                  <select class="form-control" name="icedteaPackage">
                                      <option ><?php echo $res1['icedteaPackage'];?></option> 
                                    <option value = "Iced Tea"  >
                                       Iced Tea</option>
                                  </select>
                                </div>
                              <div>
                                   <label for="sel1"  >Glass of lemon:</label>
                                  <select class="form-control" name="lemonPackage">
                                      <option ><?php echo $res1['lemonPackage'];?></option> 
                                    <option value = "Glass of lemon"  >
                                       Glass of lemon</option>
                                  </select>
                                </div>
                                <div>
                                    <label for="sel1"  >Buko Pandan:</label>
                                      <select class="form-control" name="bukoPackage">
                                          <option ><?php echo $res1['bukoPackage'];?></option> 
                                        <option value = "Buko Pandan"  >
                                           Buko Pandan</option>
                                      </select>
                                </div>
                                
                            </div>
                         <?php
                            
                          }
                    }  
                            
                        $queryString2 = "SELECT `add_services_id`, `event_system_id`, `add_services` FROM `add_services_information` WHERE `event_system_id` = '".$id."' ORDER BY `add_services_id`";    
                            
                          if($query2 = mysqli_query($con,$queryString2)or die(mysqli_error($con)."2")){
                              
                              $res2 = mysqli_fetch_assoc($query2);
                              
                          
                            ?>              
                            
                            
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
                                         
                                            <?php 
                                              if($res2['add_services']!=""){
                                                  ?>
                                           <td>
                                              <input type="checkbox" class="chkBox" name="selectedItems1" value="Mobile Bar--8000" id="AOinput1" onchange="additionalServices()" checked/>
                                              Mobile Bar</td>
                                                  <?php
                                              }else{
                                                  ?>
                                           <td>
                                              <input type="checkbox" class="chkBox" name="selectedItems1" value="Mobile Bar--8000" id="AOinput1" onchange="additionalServices()" />
                                              Mobile Bar</td>
                                                  <?php
                                                  
                                              }
                                              
                                              
                                              ?>
                                            
                                          <td>Basic sound and lights</td>
                                          <td>8000</td>
                                      </tr>
                                    <tr>
                                        
                                        <?php 
                                              if($res2['add_services']!=""){
                                                  ?>
                                              <td>
                                                  <input type="checkbox" class="chkBox" name="selectedItems2" value="Photobooth--4500" id="AOinput2"  onchange="additionalServices()" checked/>
                                                  Photobooth 
                                              </td>
                                                  <?php
                                              }else{
                                                  ?>
                                           <td>
                                                  <input type="checkbox" class="chkBox" name="selectedItems2" value="Photobooth--4500" id="AOinput2"  onchange="additionalServices()" />
                                                  Photobooth 
                                              </td>
                                                  <?php
                                                  
                                              }
                                              
                                              
                                              ?>
                                              
                                              <td>Photobooth with Roving Photographer and Tarpaulin 2x4</td>
                                              <td>4500</td>
                                      </tr>
                                          <tr>
                                              
                                              <?php 
                                              if($res2['add_services']!=""){
                                                  ?>
                                              <td>
                                                <input type="checkbox" class="chkBox" name="selectedItems3" value="Cake--3500" id="AOinput3" onchange="additionalServices()" checked/>
                                                Cake
                                              </td>
                                                  <?php
                                              }else{
                                                  ?>
                                           <td>
                                                <input type="checkbox" class="chkBox" name="selectedItems3" value="Cake--3500" id="AOinput3" onchange="additionalServices()"/>
                                                Cake
                                              </td>
                                                  <?php
                                                  
                                              }
                                              
                                              
                                              ?>
                                              
                                              
                                              
                                              <td>2 layers fondant cake (Base Edible)</td>
                                              <td>3500</td>
                                      </tr>
                                          <tr>
                                              <?php 
                                              if($res2['add_services']!=""){
                                                  ?>
                                              <td>
                                                  <input type="checkbox" class="chkBox" name="selectedItems4" value="Dessert Buffet--3500" id="AOinput4" onchange="additionalServices()" checked />
                                                  Dessert Buffet
                                              </td>
                                                  <?php
                                              }else{
                                                  ?>
                                           <td>
                                                  <input type="checkbox" class="chkBox" name="selectedItems4" value="Dessert Buffet--3500" id="AOinput4" onchange="additionalServices()" />
                                                  Dessert Buffet
                                              </td>
                                                  <?php
                                                  
                                              }
                                              
                            }
                                              ?>
                                              
                                              
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
                                            <option value = "Pusit P 600 good for 20 pax-600"  >Pusit P 600 good for 20 pax.</option>
                                            <option value = "Hipon P 600 good for 20 pax-600">Hipon P 600 good for 20 pax.</option>

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
                        <?php
                             $queryString3 = "SELECT `add_food_id`, `event_system_id`, `add_food`,`food_price` FROM `add_food_information` WHERE `event_system_id` = '".$id."' ORDER BY `add_food_id`";

                            $count = 0;
                            if($query3 = mysqli_query($con,$queryString3)or die(mysqli_error($con)."3")){
                                while($res3 = mysqli_fetch_assoc($query3)){
                                    ?>
                                    <tr id="trAdd<?php  echo $count;?>">
                                    <th style="max-width:80%;width:80%;">
                                          <?php echo $res3['add_food'] ;?>
                                        <input type="hidden" value="<?php echo $res3['add_food'] ;?>" name="add<?php  echo $count;?>" >
                                    </th>
                                     <th style="max-width:20%;width:20%;">
                                         <a class="btn btn-block btn-danger" onclick="removeAddFood('trAdd<?php echo $count;$count++;?>','<?php echo $res3['food_price'] ;?>')"> Remove</a>   
                                        
                                    </th>
                                  </tr>


                                    <?php

                                }    

                            }

                            ?>
                              
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
                                        <?php echo $pax_Event;?>
                                    </th>
                                </tr>
                               
                                <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Event Hours :
                                    </th>
                                    <th style="max-width:40%;width:40%;" id="cost-event-hours">
                                        <?php echo $eventhoursCost_Event;?> 
                                    </th>
                                </tr>
                                <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Area rate per hours :
                                    </th>
                                    <th style="max-width:40%;width:40%;" id="cost-area-rate">
                                        <?php echo $arearateCost_Event;?>  
                                    </th>
                                </tr>
                                <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Area Amount :
                                    </th>
                                    <th style="max-width:40%;width:40%;" id="cost-area-amount">
                                        <?php
                                            $a = str_split($eventhoursCost_Event);
                                            $b = $a[0]."".$a[1];
                                            $c = $a[4]."".$a[4];
                                            $d = ($b*$arearateCost_Event)+(($c/60)*$arearateCost_Event);
                                            echo $d;
                                        ?> 
                                    </th>
                                </tr>
                                 <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Package :
                                    </th>
                                    <th style="max-width:40%;width:40%;" id="cost-package">
                                        <?php echo $packageCost_Event ;?> 
                                    </th>
                                </tr>
                                <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Price per Head(VAT Inclusive) : 
                                    </th>
                                    <th style="max-width:40%;width:40%;"  id="cost-price-per-head">
                                        <?php echo $perheadCost_Event; ;?>  
                                    </th>
                                </tr>
                                <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Sub Total :
                                    </th>
                                    <th style="max-width:40%;width:40%;" id="cost-subtotal">
                                        
                                    </th>
                                </tr>
                                <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Additional Services :
                                    </th>
                                    <th style="max-width:40%;width:40%;" id="cost-add-services">
                                        <?php echo $addservicesCost_Event ;?>   
                                    </th>
                                </tr>
                                <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Additional Food :
                                    </th>
                                    <th style="max-width:40%;width:40%;" id="cost-add-food">
                                         <?php echo $addfoodCost_Event ;?>    
                                    </th>
                                </tr>
                                <tr>
                                    <th style="max-width:60%;width:60%;">
                                         Total :
                                    </th>
                                    <th style="max-width:40%;width:40%;" id="cost-total">
                                         <?php echo $totalCost_Event ;?>    
                                    </th>
                                </tr>
              
                            </tbody>
                            <input type="hidden"  id="addCount" value="<?php echo $count;?>" name="addCount">
                            <input type="hidden"  id="cost-total-input" name="cost-total-input" value="<?php echo $totalCost_Event ;?>">
                            <input type="hidden"  id="cost-add-food-input" name="cost-add-food-input" value="<?php echo $addfoodCost_Event ;?>">
                            <input type="hidden"  id="cost-add-services-input" name="cost-add-services-input" value="<?php echo $addservicesCost_Event ;?>">
                            <input type="hidden"  id="cost-price-per-head-input" name="cost-price-per-head-input" value="<?php echo $perheadCost_Event ;?>">
                            <input type="hidden"  id="cost-package-input" name="cost-package-input" value="<?php echo  $packageCost_Event ;?>">
                            <input type="hidden"  id="cost-event-hours-input" name="cost-event-hours-input" value="<?php echo $eventhoursCost_Event ;?>"> 
                            <input type="hidden"  id="cost-area-rate-input" name="cost-area-rate-input" value="<?php echo $arearateCost_Event ;?>">
                        </table>
                    <br>
                 
                         <input type="button" class="form-control" id="done-in-package-info" value="Done" style="background:#421C1E ; color:white !important;" data-toggle="modal" data-target="#myModalSubmit" >
                    </div>
                     
            
                    <br><br><br>
                </div>

                
        
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
                                
                                <input type="submit" name="update-event-submit" class="form-control" id="submit" style="background:#421C1E ; color:white !important; display:none;"> 
                        </div>

                      </div>

                    </div>
                  </div> 
                
                   
            </form>
          
      </div>
        <?php
    }else{
        echo "invalid";
    }

?>