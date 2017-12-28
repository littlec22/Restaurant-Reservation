
<?php
    
    
    session_start();
    $con   = mysqli_connect("localhost","root","","c-preciosa");
    // i used to defined the date today and month also the year
    $datestatic = date_create(date("Y-m-d"));
    //i used for css to defined the days that start of reservation
    $dateStartToReserve = date_create(date("Y-m-d"));
    date_add($dateStartToReserve,date_interval_create_from_date_string("1 days"));
    $dstr = strtotime(date_format($dateStartToReserve,"Y-m-d"));



    $gettingDate = getdate(date("U"));
    $mm = $gettingDate['mon'];
    $yy = $gettingDate['year'];
    
    //i used in view - in calendar view
    $date1;
    $firstday;
    if(isset($_GET['month'])){
         $date1 = date_create("$yy-$mm-1");
        date_add($date1,date_interval_create_from_date_string("".$_GET['month']." months"));
        $firstday =  date_format($date1,"w");
    }else{
        $date1 = date_create("$yy-$mm-1");
        $firstday =  date_format($date1,"w");
    }

    
       
    ?>
    <style>
        .calendarTable{
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            height: 400px;
            float:left;
        }

       
        .calendarTable td,.calendarTable th {
            border: 1px solid #cccccc;
            font-weight:700;
            padding: 8px;
            width: 14%;
            height: 14%;
        }
         .calendarTable th{
                background-color:#002080;
                color:white;
                height:5%;
                    
        }
        .calendarTable td{
            background-color: #f2f2f2;
            color:#808080;
            
        }
       
        .none-on-month{
            background-color: #f2f2f2;
            font-weight:200;
        }
        .calendarTable .cal-<?php echo date_format($date1,"Y-m");?>{
            background-color: white;
            color:black;
        }
        
       
        .calendarTable .cal-pointers-div{
            float:left;
            max-width: 15px;
            width: 15px;
            max-height: 15px;
            height: 15px;
            
            border: 1px solid white;
            border-radius: 2px;
            margin-right:5px;
        }
        .calendarTable .cal-pointers-div-label{
            text-align: left;
            font-family: sans-serif;
            font-size: 15px;
            font-weight:400;
            
        }
        
        .calendarTable .cal-<?php echo date_format($datestatic,"Y-m-d");?>{
            background: #4da6ff !important;
        }
        .calendarTable .dropdown-content{
            z-index: 5 !important;
            position:absolute;
            left:-5px; top:10px;
        }
        <?php 
       
        try{
            
            
           
            $query = mysqli_query($con,"SELECT `dateEvent` FROM `event_information` WHERE `dateEvent` LIKE '".date_format($date1,"Y-m")."%'  ")or die(mysqli_error($con));
            
                while($res1 = mysqli_fetch_assoc($query)){
                    ?>
        .calendarTable .cal-<?php echo $res1['dateEvent'];?>{
        background-color: #cccc00;
                          
        }
                    <?php
                }
            $holidayDate= array();
            $query = mysqli_query($con,"SELECT `holiday_day`, `holiday_status` FROM `holiday` WHERE  `holiday_status` = 'active'" )or die(mysqli_error($con));
            
                while($res1 = mysqli_fetch_assoc($query)){
                    $holidayDate[$res1['holiday_day']] = $res1['holiday_day'];
                    
                    ?>
        .calendarTable .cal-<?php echo $res1['holiday_day'];?>{
        background-color: #cc0000;
                          
        }
                    <?php
                }
            
            $eventDate = array();
            $eventId = array();
            $query = mysqli_query($con,"SELECT `event_id` , `dateEvent` FROM `event_information` WHERE `dateEvent` LIKE '".date_format($date1,"Y-m")."%' AND `cust_id` = '".$_SESSION["cust_id"]."' ")or die(mysqli_error($con));
            
                while($res1 = mysqli_fetch_assoc($query)){
                    $eventDate[$res1['dateEvent']] = $res1['dateEvent'];
                    $eventId[$res1['dateEvent']] = $res1['event_id'];
                    
                    ?>
        
        .calendarTable .cal-<?php echo $res1['dateEvent'];?>{
            background-color: #39e600;
            cursor:pointer;              
        }
                    <?php
                }
           
            
        }catch (customException $e) {
          //display custom message
          echo $e->errorMessage();
        }
            


            
            
        
        
        
            ?>
    </style>
    
   
    <table class="calendarTable">
        <thead>
            <tr>
                <th colspan ="7" class="cal-pointers-th">
                    <div class="cal-pointers" style="float:left;">
                        <div class="cal-pointers-div" style="background:#33cc33 !important;"></div><label class="cal-pointers-div-label"> Your Event Date</label>
                        </div>
                    <div class="cal-pointers" style="float:left;margin-left:20px">
                        <div class="cal-pointers-div" style="background:#4da6ff !important;"></div><label class="cal-pointers-div-label"> Now</label>
                        </div>
                    <div class="cal-pointers" style="margin-left:20px">
                        <div class="cal-pointers-div" style="background:#cc0000 !important;"></div><label class="cal-pointers-div-label"> Holiday</label>
                    </div>
                    <div class="cal-pointers" style="float:none;display:block;">
                        <div class="cal-pointers-div" style="background:#cccc00 !important;"></div><label class="cal-pointers-div-label"> Used date by others (checked this maybe your time desire is available) .</label>
                    </div>
                </th>
            </tr>
            <tr>
                <th colspan ="7" class="cal-mnth-name-th">
                    <h4 style="float:left;   "><?php echo date_format($date1,"F"); ?> - <?php echo date_format($date1,"Y"); ?></h4>
                    <div class="btn-group" style="float:left; margin:5px 0 0 10px; ">
                      <button type="button" class="btn btn-primary" onclick="document.getElementById('moveMonthInput').value--;var x = document.getElementById('moveMonthInput').value ;moveMonthCalendarEvent(x);"><span class="glyphicon glyphicon-chevron-left"></span></button>
                      <button type="button" class="btn btn-primary" onclick="document.getElementById('moveMonthInput').value++;var x = document.getElementById('moveMonthInput').value ;moveMonthCalendarEvent(x);"><span class="glyphicon glyphicon-chevron-right"></span></button>
                    </div>
                </th>
            </tr>
            
        </thead>
        <tr>
            <th style="color:#e60000 !important;" >Sun</td>
            <th>Mon</td>
            <th>Tue</td>
            <th>Wed</td>
            <th>Thu</td>
            <th>Fri</td>
            <th>Sat</td>
        </tr>
        <tr>
           <?php
                if($firstday == "0"){
                    ?>
            <td class=" cal-<?php  echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d"); ?>
                       
            </td>
            
            
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                        
                       <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d"); ?>
                    </td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    
                    <?php
                }else if($firstday == "1"){
                    ?>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("-1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
            <?php
                }else if($firstday == "2"){
                    ?>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("-2 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <?php
                }else if($firstday == "3"){
                    ?>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("-3 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <?php
                }else if($firstday == "4"){
                    ?>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("-4 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <?php
                }else if($firstday == "5"){
                    ?>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("-5 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <?php
                }else if($firstday == "6"){
                    ?>
          
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("-6 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <?php
                }
            ?>
            
            
        </tr>
        <tr>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                          <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>> 
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>  
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>>
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>> 
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> > 
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    
        </tr>
        <tr>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?> >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  >
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    
        </tr>
        <tr>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>   > 
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>   > 
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  >
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    
        </tr>
<?php 
  
    
    if($firstday == "6"){
        
        ?>
                <tr>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>   > 
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  >
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>   >
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?>
                    </td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>   >
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
                    
                </tr>
                <tr>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?>
                    </td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?> <?php echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    
                </tr>
        <?php
    }else{
         ?>
            <tr>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>   >
                        <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"   <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>  > 
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  <?php if(isset($eventId[date_format($date1,"Y-m-d")])){ ?> onclick="loadEventInfo('<?php echo $eventId[date_format($date1,"Y-m-d")] ; ?>');" <?php } ?>   >
                         <?php if((!isset($holidayDate[date_format($date1,"Y-m-d")]))&&($dstr <= strtotime(date_format($date1,"Y-m-d"))) ){ ?> <div class="w3-dropdown-click" style="color:black !important; float:right;"> <a style="color:black !important; float:right;" onclick="dropDownReserve('dd-<?php echo date_format($date1,"Y-m-d"); ?>')" ><span class="glyphicon glyphicon-option-vertical"> </span></a>  <div id="dd-<?php echo date_format($date1,"Y-m-d"); ?>"  class="w3-dropdown-content w3-border" style="margin-top:-3px;margin-left:20px;z-index:5;"> <a href="reservation.php?eventDate=<?php echo date_format($date1,"Y-m-d"); ?>" style="padding:4px;">Reserve Event</a> </div> </div> <?php } ?>
                        <?php  echo date_format($date1,"d");?></td>
            
                    
            </tr>
        <?php
    }
?>
        
        
        

    </table>
    <?php
    
   
?>