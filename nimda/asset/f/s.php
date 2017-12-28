<?php
    
                $a = strtotime("07:00");
echo $a."<br>";
echo $a/1000/60/60;
?>

<html>
<body>

<p>Click the button to display an alert box:</p>
<input type="checkbox" id="1" onchange="as(this)">
<button onclick="try{timeDifference('12:00','10:40');}catch(err){
                alert(err.message);
            }">Try it</button>
<script>
    function as(el){
        if(el.checked){
            alert('kupal');
        }
    }
        
    
</script>

</body>

<!-- Mirrored from www.w3schools.com/js/tryit.asp?filename=tryjs_alert by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Jan 2017 18:14:38 GMT -->
</html>