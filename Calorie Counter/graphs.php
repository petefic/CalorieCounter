<?php include "base.php"; ?>
<?php session_start (); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Calorie Counter - Logint</title>
<link href="oneColFixCtrHdr.css" rel="stylesheet" type="text/css">

<?php


$user = $_SESSION['Username'];
$months = array(1,2,3,4,5,6,7,8,9,10,11,12);
$weights = array(0,0,0,0,0,0,0,0,0,0,0,0);

for($i=0;$i<12;$i++){

	$result = mysql_query("SELECT * FROM info WHERE user='$user' AND month='$months[$i]'");
	
	if(mysql_num_rows($result)) {
		while($row = mysql_fetch_array($result))
		  {
			$weights[$i] = $row['weight'];
		
		  }
	}
}
?>

<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.1.min.js"></script>
<script>
    var graph;
    var xPadding = 30;
    var yPadding = 30;
	
    var janWeight = <?php echo $weights[0] ?>;
	var febWeight = <?php echo $weights[1] ?>;
	var marWeight = <?php echo $weights[2] ?>;
	var aprWeight = <?php echo $weights[3] ?>;
	var mayWeight = <?php echo $weights[4] ?>;
	var junWeight = <?php echo $weights[5] ?>;
	var julWeight = <?php echo $weights[6] ?>;
	var augWeight = <?php echo $weights[7] ?>;
	var sepWeight = <?php echo $weights[8] ?>;
	var octWeight = <?php echo $weights[9] ?>;
	var novWeight = <?php echo $weights[10] ?>;
	var decWeight = <?php echo $weights[11] ?>;
    
    var data = { values:[
            { X: "Jan", Y: janWeight },
            { X: "Feb", Y: febWeight },
            { X: "Mar", Y: marWeight },
            { X: "Apr", Y: aprWeight },
            { X: "May", Y: mayWeight },
            { X: "Jun", Y: junWeight },
            { X: "Jul", Y: julWeight },
            { X: "Aug", Y: augWeight },
            { X: "Sep", Y: sepWeight },
            { X: "Oct", Y: octWeight },
            { X: "Nov", Y: novWeight },
            { X: "Dec", Y: decWeight },
    ]};
    
    // Returns the max Y value in our data list
    function getMaxY() {
        var max = 0;
        
        for(var i = 0; i < data.values.length; i ++) {
            if(data.values[i].Y > max) {
                max = data.values[i].Y;
            }
        }
        
        max += 10 - max % 10;
        return max;
    }
    
    // Return the x pixel for a graph point
    function getXPixel(val) {
        return ((graph.width() - xPadding) / data.values.length) * val + (xPadding * 1.5);
    }
    
    // Return the y pixel for a graph point
    function getYPixel(val) {
        return graph.height() - (((graph.height() - yPadding) / getMaxY()) * val) - yPadding;
    }

    $(document).ready(function() {
        graph = $('#graph');
        var c = graph[0].getContext('2d');            
        
        c.lineWidth = 2;
        c.strokeStyle = '#333';
        c.font = 'italic 8pt sans-serif';
        c.textAlign = "center";
        
        // Draw the axises
        c.beginPath();
        c.moveTo(xPadding, 0);
        c.lineTo(xPadding, graph.height() - yPadding);
        c.lineTo(graph.width(), graph.height() - yPadding);
        c.stroke();
        
        // Draw the X value texts
        for(var i = 0; i < data.values.length; i ++) {
            c.fillText(data.values[i].X, getXPixel(i), graph.height() - yPadding + 20);
        }
        
        // Draw the Y value texts
        c.textAlign = "right"
        c.textBaseline = "middle";
        
        for(var i = 0; i < getMaxY(); i += 10) {
            c.fillText(i, xPadding - 10, getYPixel(i));
        }
        
        c.strokeStyle = '#f00';
        
        // Draw the line graph
        c.beginPath();
        c.moveTo(getXPixel(0), getYPixel(data.values[0].Y));
        for(var i = 1; i < data.values.length; i ++) {
            c.lineTo(getXPixel(i), getYPixel(data.values[i].Y));
        }
        c.stroke();
        
        // Draw the dots
        c.fillStyle = '#333';
        
        for(var i = 0; i < data.values.length; i ++) {  
            c.beginPath();
            c.arc(getXPixel(i), getYPixel(data.values[i].Y), 4, 0, Math.PI * 2, true);
            c.fill();
        }
    });
</script>

</head>

<body>

<div class="container">

  <div class="header"><a href="#"><img src="logo.jpg" name="Insert_logo" width="180" height="90" id="Insert_logo" style="background: #C6D580; display:block;" /></a>
    <!-- end .header --></div>
    
  <div class="content">
    
  
  <canvas id="graph" width="500" height="450">   
</canvas>
  
    
    <!-- end .content --></div>
    
  <div class="footer">
  
  	<a href="main.php">Back to main page</a>
	<a href="faq.html">FAQ</a>
    <a href="logout.php">Log Out</a>
  
    <!-- end .footer --></div>
    
  <!-- end .container --></div>
</body>
</html>
