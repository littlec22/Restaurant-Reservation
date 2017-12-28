
<?php
    
  
    

    // i used to defined the date today and month also the year
    $datestatic = date_create(date("Y-m-d"));
    //i used for css to defined the days that are not member of the current month
    $dateforexcess = date_create(date("Y-m-d"));
   
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
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            height: 100%;
        }

       
        td, th {
            border: 1px solid #000000;
            text-align:center;
            font-weight:700;
            padding: 8px;
            width: 14%;
            height: 14%;
        }
         th{
                background-color: #999999;
                color:white;
                height:5%;
                    
        }
        td{
            background-color: #f2f2f2;
            color:#808080;
        }
       
        .none-on-month{
            background-color: #f2f2f2;
            font-weight:200;
        }
        .cal-<?php echo date_format($date1,"Y-m");?>{
            background-color: white;
            color:black;
        }
        
        .cal-2017-08-14{
            background: #33cc33;
        }
        .cal-2017-08-03{
            background: #33cc33;
        }
        .cal-pointers-th{
            text-align: left;
        }
        .cal-pointers{
            text-align: left;
            float:left;
            margin:0 20px 0 0 ;
        }
        .cal-pointers-div{
            float:left;
            max-width: 15px;
            width: 15px;
            max-height: 15px;
            height: 15px;
            
            border: 1px solid white;
            border-radius: 2px;
            margin-right:5px;
        }
        .cal-pointers-div-label{
            text-align: left;
            font-family: sans-serif;
            font-size: 15px;
            font-weight:400;
            
        }
       
    </style>
    <table>
        <thead>
            <tr>
                <th colspan ="7" class="cal-pointers-th">
                    <div class="cal-pointers">
                        <div class="cal-pointers-div" style="background:#33cc33 !important;"></div><label class="cal-pointers-div-label"> Your Event Date</label>
                        </div>
                    <div class="cal-pointers">
                        <div class="cal-pointers-div" style="background:#cc0000 !important;"></div><label class="cal-pointers-div-label"> Holiday</label>
                    </div>
                </th>
            </tr>
            <tr>
                <th colspan ="7" class="cal-mnth-name-th">
                    <?php echo date_format($date1,"F");?>
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
                    <td class=" cal-<?php  echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" ><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" ><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    
                    <?php
                }else if($firstday == "1"){
                    ?>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("-1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" ><?php echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
            <?php
                }else if($firstday == "2"){
                    ?>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("-2 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" ><?php echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <?php
                }else if($firstday == "3"){
                    ?>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("-3 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" ><?php echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <?php
                }else if($firstday == "4"){
                    ?>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("-4 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" ><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <?php
                }else if($firstday == "5"){
                    ?>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("-5 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" ><?php echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <?php
                }else if($firstday == "6"){
                    ?>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("6 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" ><?php echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <td class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"><?php  echo date_format($date1,"d");?></td>
                    <?php
                }
            ?>
            
            
        </tr>
        <tr>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    
        </tr>
        <tr>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    
        </tr>
        <tr>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    
        </tr>
<?php 
  
    
    if($firstday == "6"){
        
        ?>
                <tr>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    
                </tr>
                <tr>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    
                </tr>
        <?php
    }else{
         ?>
            <tr>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>"  style="color:#e60000 !important;" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    <td  class=" cal-<?php date_add($date1,date_interval_create_from_date_string("1 days")); echo date_format($date1,"Y-m-d"); echo " cal-".date_format($date1,"Y-m"); ?>" > <?php  echo date_format($date1,"d");?></td>
                    
            </tr>
        <?php
    }
?>
        
        
        

    </table>
    <?php
    
   
?>