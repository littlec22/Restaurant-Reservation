    
function loginUser(loc){

                try{
                        
                    document.getElementById('loading-open').click();
                       var un = document.getElementById('uname');
                        var pw = document.getElementById('pword');
                   
                        


                        if(un.value != ""){
                            
                           if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }
                       
                            xmlhttp.onreadystatechange = function(){
                                 
                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                        
                                  
                                    var result = xmlhttp.responseText;
                                    if(result == "success"){
                                       
                                        document.getElementById('loading-close').click();
                                        window.location = loc;
                                        
                                    }else if(result=="invalid"){
                                            document.getElementById('loading-close').click();
                                            var un_div = document.getElementById('un-div');
                                            var pw_div = document.getElementById('pw-div');
                                            un_div.classList.toggle("has-error")
                                            un_div.classList.toggle("has-feedback")
                                            pw_div.classList.toggle("has-error")
                                            pw_div.classList.toggle("has-feedback")

                                            document.getElementById('loginx1').style.visibility = "visible";
                                            document.getElementById('loginx2').style.visibility = "visible";
                                            
                                    }

                                };
                                
                            };


                            xmlhttp.open("GET","f/function.php?unnname="+un.value+"&pwwword="+pw.value,true);
                           
                            xmlhttp.send();


                    
                    }else{
                        
                        var un_div = document.getElementById('un-div');
                        var pw_div = document.getElementById('pw-div');
                        un_div.classList.toggle("has-error")
                        un_div.classList.toggle("has-feedback")
                        pw_div.classList.toggle("has-error")
                        pw_div.classList.toggle("has-feedback")
                      
                        document.getElementById('loginx1').style.visibility = "visible";
                        document.getElementById('loginx2').style.visibility = "visible";
                        
                        document.getElementById('loading-close').click();
                    }
                }catch(err){
                    alert(err.message);
                    document.getElementById('loading-close').click();
                }
			}
        
        
      //registration

        
      //for selecting areas 
        function areasMaxPax(el){
            var paxInput = document.getElementById('paxEvent');
            var areaRate = document.getElementById('areaRate');
           
            if(el.value=="VIP 1 max capacity is 30 pax"){
                paxInput.max = "30";
                areaRate.value = "P 1,000 per hour";
                
            }
            else if(el.value =="VIP 2 max capacity is 40 pax"){
                paxInput.max = "40";
                areaRate.value = "P 1,500 per hour";
            }
            else if(el.value =="VIP 3 max capacity is 50 pax"){
               paxInput.max = "50";
                areaRate.value = "P 2,000 per hour";
            }
            else if(el.value =="Garden Area max capacity is 30 pax"){
                paxInput.max = "150";
                areaRate.value = "P 3,000 per hour";
            }
            else if(el.value =="Dine-in max capacity is 40 pax"){
                paxInput.max = "40";
                areaRate.value = "P 800 per hour";
            }
                
        }
        
         function dateSetMax(el){
            var d = new Date();
             var y = (d.getFullYear()).toString();
             var m = (d.getMonth()+1).toString();
             var d = (d.getDate()+3).toString();
                
            if(m.length == 1 ){
               
                m = "0"+m;
            }
             if(d.length == 1 ){
               
                d = "0"+d;
            }
             
           el.min = y+"-"+m+"-"+d;
          
                
        }
        
        
        function packageSelect(el){
                try{
                        
                       
                       var div = document.getElementById('packageLaman');
                     
                   
                        


                        if(el.value != ""){
                            
                           if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }
                       
                            xmlhttp.onreadystatechange = function(){
                                 
                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                        
                                  
                                    div.innerHTML = xmlhttp.responseText;
                                    

                                };
                                
                            };


                            xmlhttp.open("GET","p.php?p="+el.value,true);
                           
                            xmlhttp.send();


                    
                    }
                }catch(err){
                    alert(err.message);
                }
			}
        function checkAvailability(){

                try{
                        document.getElementById('loading-open').click();
                       // document.getElementById('loading-open').click();
                        var event_info_div = document.getElementById('event-info');
                        var package_info_div = document.getElementById('package-info');
                        var event_type = document.getElementById('typeEvent');
                        var event_area = document.getElementById('areaEvent'); 
                        var event_pax = document.getElementById('paxEvent'); 
                        var event_date = document.getElementById('dateEvent'); 
                        var event_start = document.getElementById('startEvent'); 
                        var event_end = document.getElementById('endEvent'); 
                        var event_rep = document.getElementById('repEvent'); 
                        var event_warning_1 = document.getElementById('warning-1'); 
                        var event_warning_2 = document.getElementById('warning-2'); 
                        var event_check_info = document.getElementById('checkEventInfo'); 
                        var wronginput = "We cannot check your event information, some input are wrong.";
                        var notavailable = "The time was not available on this area and that that date.";
                        var available = "Your event information is available right now. <a href='#' style='cursor:pointer;background:#421C1E !important; color:white !important;' onclick='setUpPackage();' class='btn' > Click this to set up your package. </a> ";
                        
                       
                        if((event_type.value != "")&&(event_area.value != "")&&(event_pax.value != "")&&(event_date.value != "")&&(event_start.value != "")&&(event_end.value != "")&&(event_rep.value != "")&&(timeDifferenceBool(event_start.value,event_end.value))){
                                event_warning_1.innerHTML = wronginput;
                                event_warning_2.innerHTML = wronginput;
                                event_warning_1.style.display = "none";
                                event_warning_2.style.display = "none";
                            
                             
                            if(event_check_info.value == "Check Availability"){
                                
                                
                                if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                                }else{
                                    xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                                }
                       
                                xmlhttp.onreadystatechange = function(){
                                 
                                    if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                        
                                  
                                        var result = xmlhttp.responseText;
                                        if(result == "available"){
                                            event_warning_1.innerHTML = available;
                                            event_warning_2.innerHTML = available;
                                            event_warning_1.style.display = "block";
                                            event_warning_2.style.display = "block";
                                            event_warning_1.style.background = "rgb(173, 235, 173)";
                                            event_warning_2.style.background = "rgb(173, 235, 173)";
                                            
                                            document.getElementById('loading-close').click();
                                       // document.getElementById('loading-close').click();
                                        //window.location = "index.php";
                                        
                                        }else{
                                            
                                            event_warning_1.innerHTML = notavailable;
                                            event_warning_2.innerHTML = notavailable;
                                            event_warning_1.style.display = "block";
                                            event_warning_2.style.display = "block";
                                            document.getElementById('loading-close').click();
                                            
                                        }

                                    };
                                
                                };

                               
                                
                                xmlhttp.open("GET","f/function.php?event_start="+event_start.value+"&event_end="+event_end.value+"&event_area="+event_area.value+"&event_date="+event_date.value,true);

                                xmlhttp.send();
                               
                                
                                
                            }
                            
                          


                    
                    }else{
                        event_warning_1.innerHTML = wronginput;
                        event_warning_2.innerHTML = wronginput;
                        event_warning_1.style.display = "block";
                        event_warning_2.style.display = "block";
                        document.getElementById('loading-close').click();
                    }
                }catch(err){
                    alert(err.message);
                    document.getElementById('loading-close').click();
                }
			}
    
        function setUpPackage(){
            try{
                                var event_info_div = document.getElementById('event-info');
                                var package_info_div = document.getElementById('package-info');
                                event_info_div.style.display = "none";
                                package_info_div.style.display = "block";
                               
                                
                                    document.getElementById('loading-close').click();
                                    var event_warning_1 = document.getElementById('warning-1'); 
                                    var event_warning_2 = document.getElementById('warning-2'); 
                                    event_warning_1.style.display = "none";
                                    event_warning_2.style.display = "none";
                                
                                    
                                    computeVenue();
                                    packagePrice(document.getElementById('typePackage1'));
                                    
            }catch(err){
                alert(err.message);
            }
                                
            
        }
        function addingFood(){
            try{
                
                var addCount = document.getElementById("addCount");
                var addSelector = document.getElementById("additionalFoodSelect");
                var table = document.getElementById("additionalFoodTable");
                var Ttable = document.getElementById("additionalFoodTable-t");
                
                var ar = addSelector.value.split("-");
                var foodname = ar[0];
                var foodprice = ar[1];
                //for adding interface of add food
                addCount.value++;
               
                document.getElementById("addCount").value = (addCount.value).toString();
                //for tr
                var tr = document.createElement("tr");
                tr.setAttribute("id","trAdd"+addCount.value);
                //for th1
                var th1 = document.createElement("th");
                th1.innerHTML = foodname;
                var input1 = document.createElement("input");
                input1.setAttribute("type", "hidden");
                input1.setAttribute("name","addfood"+addCount.value);
                input1.setAttribute("value", foodname); 
                th1.appendChild(input1);
                var input2 = document.createElement("input");
                input2.setAttribute("type", "hidden");
                input2.setAttribute("name","addfoodprice"+addCount.value);
                input2.setAttribute("value", foodprice); 
                th1.appendChild(input2);
                //for th2
                var th2 = document.createElement("th");
                var button =  document.createElement("a");
                button.setAttribute("class","btn btn-block btn-danger");
                button.setAttribute("onclick","removeAddFood('trAdd"+addCount.value+"','"+foodprice+"')");
                button.textContent = "Remove";
                th2.appendChild(button);
                
                tr.appendChild(th1);
                tr.appendChild(th2);
                
                Ttable.appendChild(tr);
                
                
                //computing value
                var a = document.getElementById('cost-add-food');
                var aa = document.getElementById('cost-add-food-input');
                
                a.innerHTML = parseFloat(foodprice) + parseFloat(a.innerHTML);
                aa.value = a.innerHTML;
                computeTotal();
            }catch(err){
                alert(err.message);
            }
            
            
        }
        function removeAddFood(id,price){
            try{
                var addCount = document.getElementById("addCount");
                var tr = document.getElementById(id);
                var Ttable = document.getElementById("additionalFoodTable-t");
                Ttable.removeChild(tr);
                addCount.value--;
                
                var a = document.getElementById('cost-add-food');
                a.innerHTML =  parseFloat(a.innerHTML) - parseFloat(price);
                var aa = document.getElementById('cost-add-food-input');
                aa.value = parseFloat(aa.value) - parseFloat(price);
                computeTotal();
            }catch(err){
                alert(err.message);
            }
            
        }
        
        function packagePrice(el){
            try{
                var pax = document.getElementById('paxEvent').value;
               
                if(el.value="Package 1"){

                    if((pax>0)&&(pax<=15)){
                        document.getElementById('cost-package').innerHTML ="7944.5";
                        document.getElementById('cost-price-per-head').innerHTML = "530";
                    }else if(((pax>=16)&&(pax<=25))){
                        document.getElementById('cost-package').innerHTML ="11123.5";
                        document.getElementById('cost-price-per-head').innerHTML = "445";
                    }else if(((pax>=26)&&(pax<=35))){
                        document.getElementById('cost-package').innerHTML ="19869";
                        document.getElementById('cost-price-per-head').innerHTML = "568";
                    }else if(((pax>=36)&&(pax<=50))){
                        document.getElementById('cost-package').innerHTML ="30636.5";
                        document.getElementById('cost-price-per-head').innerHTML = "613";
                    }else if(((pax>=51)&&(pax<=60))){
                        document.getElementById('cost-package').innerHTML ="34134.5";
                        document.getElementById('cost-price-per-head').innerHTML = "538";
                    }else if(((pax>=61)&&(pax<=80))){
                        document.getElementById('cost-package').innerHTML ="44130.5";
                        document.getElementById('cost-price-per-head').innerHTML = "552";
                    }else if(((pax>=81)&&(pax<=90))){
                        document.getElementById('cost-package').innerHTML ="50211.5";
                        document.getElementById('cost-price-per-head').innerHTML = "558";
                    }else if(((pax>=101)&&(pax<=110))){
                        document.getElementById('cost-package').innerHTML ="60431";
                        document.getElementById('cost-price-per-head').innerHTML = "549";
                     }else if(((pax>=111)&&(pax<=120))){
                        document.getElementById('cost-package').innerHTML ="65865";
                        document.getElementById('cost-price-per-head').innerHTML = "549";
                    }else if(((pax>=121)&&(pax<=130))){
                        document.getElementById('cost-package').innerHTML ="74112";
                        document.getElementById('cost-price-per-head').innerHTML = "570";
                    }else if(((pax>=131)&&(pax<=140))){
                        document.getElementById('cost-package').innerHTML ="75366";
                        document.getElementById('cost-price-per-head').innerHTML = "538";
                    }else if(((pax>=141)&&(pax<=150))){
                        document.getElementById('cost-package').innerHTML ="79357.5";
                        document.getElementById('cost-price-per-head').innerHTML = "529";

                    }else if(((pax>=91)&&(pax<=100))){
                        document.getElementById('cost-package').innerHTML ="79357.5";
                        document.getElementById('cost-price-per-head').innerHTML = "529";


                    }

                    document.getElementById('cost-package-input').value = document.getElementById('cost-package').innerHTML;
                    document.getElementById('cost-price-per-head-input').value = document.getElementById('cost-price-per-head').innerHTML;

                    computeTotal();
                }else{

                }
            }catch(err){
                alert(err.message);
            }
            
        }
        
        function additionalServices(){
                try{
                    var a = document.getElementById('cost-add-services');
                    var aa = document.getElementById('cost-add-services-input');
                    var ao1 = document.getElementById('AOinput1');
                    var ao2 = document.getElementById('AOinput2');
                    var ao3 = document.getElementById('AOinput3');
                    var ao4 = document.getElementById('AOinput4');
                    var t = 0;
                    if(ao1.checked == true){
                        t =  8000 + t ;
                    }
                    if(ao2.checked == true){
                        t = 4500+ t ;
                    }
                    if(ao3.checked == true){
                        t = 3500+ t;
                    }
                    if(ao4.checked == true){
                         
                      t = 3500+t ;
                    }
                    a.innerHTML = t;
                    aa.value =t ;
                    computeTotal();
                }catch(err){
                    alert(err.message);
                }
                    
        }
        
        function computeTotal(){
            var a = document.getElementById('cost-add-services');
            var b = document.getElementById('cost-add-food');
            var c = document.getElementById('cost-package');
            var d =  document.getElementById('cost-area-amount');
            var t = document.getElementById('cost-total');
        
            
            var tt = document.getElementById('cost-total-input');
            t.innerHTML = parseFloat(a.innerHTML) + parseFloat(b.innerHTML) + parseFloat(c.innerHTML) + parseFloat(d.innerHTML);
            tt.value = (parseFloat(a.innerHTML) + parseFloat(b.innerHTML) + parseFloat(c.innerHTML)+ parseFloat(d.innerHTML)).toString();
        }
        function computeVenue(){
            var el = document.getElementById('areaEvent');
           var areaRateInput =  document.getElementById('cost-area-rate-input');
           var eventHoursInput =  document.getElementById('cost-event-hours-input');
            var areaRate =  document.getElementById('cost-area-rate');
           var areaHours =  document.getElementById('cost-event-hours');
           var areaAmount =  document.getElementById('cost-area-amount');
            var time  = timeDifference(document.getElementById('startEvent').value,document.getElementById('endEvent').value);
            var t = time.split(":");
            var h = t[0];
            var m = t[1];
            
            if(el.value=="VIP 1 max capacity is 30 pax"){
                areaHours.innerHTML = time;
                areaRate.innerHTML = "1000";
                eventHoursInput.value = time;
                areaRateInput.value = "1000";
                
                areaAmount.innerHTML = (((h * 1000)+((m/60)*1000))).toString();
                
            }
            else if(el.value =="VIP 1 max capacity is 30 pax"){
               
              
                areaHours.innerHTML = time;
                areaRate.innerHTML = "1500";
                eventHoursInput.value = time;
                areaRateInput.value = "1500";
                
                areaAmount.innerHTML = ((h * 1500)+((m/60)*1500)).toString();
            }
            else if(el.value =="VIP 1 max capacity is 30 pax"){
               
                
                areaHours.innerHTML = time;
                areaRate.innerHTML = "2000";
                eventHoursInput.value = time;
                areaRateInput.value = "2000";
                
                areaAmount.innerHTML = ((h * 2000)+((m/60)*2000)).toString();
            }
            else if(el.value =="Garden Area max capacity is 30 pax"){
                
                areaHours.innerHTML = time;
                areaRate.innerHTML = "3000";
                eventHoursInput.value = time;
                areaRateInput.value = "3000";
                
                areaAmount.innerHTML = ((h * 3000)+((m/60)*3000)).toString();
            }
            else if(el.value =="Dine-in max capacity is 30 pax"){
                
                areaHours.innerHTML = time;
                areaRate.innerHTML = "800";
                eventHoursInput.value = time;
                areaRateInput.value = "800";
                
                areaAmount.innerHTML = ((h * 800)+((m/60)*800)).toString();
            }
        }
        
        function timeDifferenceBool(start,end){
            try{
                start = start.split(":");
                end = end.split(":");
                var startDate = new Date(0,0,0,start[0],start[1],0);
                var endDate = new Date(0,0,0,end[0],end[1],0);
                var diff = endDate.getTime() - startDate.getTime();
                if(diff <= 0 ){
                   return false;
                }else{
                    var hours = Math.floor(diff / 1000 / 60 / 60);
                    diff -= hours * 1000 * 60 * 60;
                    var minutes = Math.floor(diff / 1000 / 60);

                    if( hours < 0 )
                        hours = hours + 24;

                    
                    //return (hours <= 9 ? "0" : "") + hours.toString() + ":" +( minutes <= 9 ? "0" : "")+minutes.toString();
                    return true;
                }
                
            }catch(err){
                alert(err.message);
            }
            
            
        }
        function timeDifference(start,end){
            try{
                start = start.split(":");
                end = end.split(":");
                var startDate = new Date(0,0,0,start[0],start[1],0);
                var endDate = new Date(0,0,0,end[0],end[1],0);
                var diff = endDate.getTime() - startDate.getTime();
                
                    var hours = Math.floor(diff / 1000 / 60 / 60);
                    diff -= hours * 1000 * 60 * 60;
                    var minutes = Math.floor(diff / 1000 / 60);

                    if( hours < 0 )
                        hours = hours + 24;

                    
                    return (hours <= 9 ? "0" : "") + hours.toString() + ":" +( minutes <= 9 ? "0" : "")+minutes.toString();
                    
                
                
            }catch(err){
                alert(err.message);
            }
            
            
        }



        function loadEventInfo(id){
            try{
                        
                    document.getElementById('loading-open').click();
                     
                       
                            
                           if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }
                       
                            xmlhttp.onreadystatechange = function(){
                                 
                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                        
                                  
                                    var result = xmlhttp.responseText;
                                    if(result != "invalid"){
                                        
                                        document.getElementById('tableBodyEventInfo').innerHTML = result;
                                        document.getElementById('remainingDays').innerHTML = dateDifference(document.getElementById('dateEvent').innerHTML);
                                        document.getElementById('loading-close').click();
                                        
                                    }else{
                                        document.getElementById('loading-close').click();
                                            
                                            
                                    }

                                };
                                
                            };
                
                           
                            xmlhttp.open("GET","f/function.php?loadEventInfo="+id,true);
                           
                            xmlhttp.send();


                }catch(err){
                    alert(err.message);
                    document.getElementById('loading-close').click();
                }
        }
        
        function updateEvent(id){
            try{
                        
                    document.getElementById('loading-open').click();
                     
                       
                            
                           if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }
                       
                            xmlhttp.onreadystatechange = function(){
                                 
                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                        
                                  
                                    var result = xmlhttp.responseText;
                                    if(result != "invalid"){
                                        
                                        document.getElementById('modal-body-update').innerHTML = result;
                                         document.getElementById('loading-close').click();
                                         document.getElementById('update-open').click();
                                         
                                        
                                    }else{
                                        
                                        document.getElementById('loading-close').click();
                                            
                                            
                                    }

                                };
                                
                            };
                
                           
                            xmlhttp.open("GET","updateReservation.php?eventId="+id,true);
                           
                            xmlhttp.send();


                }catch(err){
                    alert(err.message);
                    document.getElementById('loading-close').click();
                }
        }
        function cancelEvent(id){
            try{
                        
                    document.getElementById('cancel-close').click();
                    document.getElementById('loading-open').click();
                     
                       
                            
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
                                        document.getElementById('modalOuputH1').innerHTML = "Cancel Event Successful";
                                        document.getElementById('output-open').click();
                                        loadEventInfo2(id);  
                                    }else{
                                        
                                        document.getElementById('loading-close').click();
                                        document.getElementById('modalOuputH1').innerHTML = "Cancel Event Unsuccessful";
                                        document.getElementById('output-open').click();
                                            
                                            
                                    }

                                };
                                
                            };
                
                           
                            xmlhttp.open("GET","f/function.php?cancelEvent="+id,true);
                           
                            xmlhttp.send();


                }catch(err){
                    alert(err.message);
                    document.getElementById('modalOuputH1').innerHTML = "Cancel Event Unsuccessful";
                    document.getElementById('loading-close').click();
                    document.getElementById('output-open').click();
                }
        }
        
        function loadEventInfo2(id){
            try{
                        
                     
                       
                            
                           if(window.XMLHttpRequest){
                                xmlhttp = new XMLHttpRequest();

                            }else{
                                xmlhttp = new ActivexObject("Microsoft.XMLHTTP");

                            }
                       
                            xmlhttp.onreadystatechange = function(){
                                 
                                if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                                   
                                        
                                  
                                    var result = xmlhttp.responseText;
                                    if(result != "invalid"){
                                        
                                        document.getElementById('tableBodyEventInfo').innerHTML = result;
                                        document.getElementById('remainingDays').innerHTML = dateDifference(document.getElementById('dateEvent').innerHTML);
                                     
                                        
                                    }else{
                                            
                                            
                                    }

                                };
                                
                            };
                
                           
                            xmlhttp.open("GET","f/function.php?loadEventInfo="+id,true);
                           
                            xmlhttp.send();


                }catch(err){
                    alert(err.message);
                   
                }
        }
    function dateDifference(yourDate){
        try{
            
                var d = new Date();
                 var y = (d.getFullYear()).toString();
                 var m = (d.getMonth()+1).toString();
                 var dd = (d.getDate()).toString();
                var yd = yourDate.split("-");

                var diffY = 0;
                var diffM = 0 ;
                var diffD = 0;

                if(parseInt(y)==parseInt(yd[0])){
                    diffY = 0;
                        if(parseInt(m)==parseInt(yd[1])){
                            diffM = 0;
                            if(parseInt(dd)==parseInt(yd[2])){
                                diffD = 0;
                            }else{
                                diffD =  parseInt(yd[2])-parseInt(dd);
                            }
                        }else{
                            diffM =  parseInt(yd[1])-parseInt(m);
                             if(parseInt(dd)==parseInt(yd[2])){
                                diffD = 0;
                            }else{
                                diffD =  parseInt(yd[2])-parseInt(dd);
                            }
                        }
                }else{
                    diffY = parseInt(yd[0])-parseInt(y); 
                    if(parseInt(m)==parseInt(yd[1])){
                            diffM = 0;
                            if(parseInt(dd)==parseInt(yd[2])){
                                diffD = 0;
                            }else{
                                diffD =  parseInt(yd[2])-parseInt(dd);
                            }
                        }else{
                            diffM =  parseInt(yd[1])-parseInt(m);
                             if(parseInt(dd)==parseInt(yd[2])){
                                diffD = 0;
                            }else{
                                diffD =  parseInt(yd[2])-parseInt(dd);
                            }
                        }
                }

                var output = "";
                if(diffY >=0 ){
                    var output = (diffY == 0 ) ? "" : diffY.toString() + " year(s) "
                    

                    if(diffM >=0 ){
                         var output = (diffM == 0 ) ?  output +"" : output + diffM.toString() + " month(s) "
                        

                        if(diffD >=0 ){
                            var output = (diffD == 0 ) ?  output + ""+ diffD.toString() : output + diffD.toString() + " day(s)";
                            
                            return output+" to go.";
                        }else{
                            output = "Done!";
                            return output;
                        }

                    }else{
                        output = "Done!";
                        return output;
                    }

                }else{
                    output = "Done!";
                    return output;
                }


            }catch(err){
                alert(err.message);
            }


        }
