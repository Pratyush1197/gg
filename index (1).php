<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="main.css"/>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Barlow' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Passion One' rel='stylesheet'>
    <title></title>
  </head>
  <body>
<?php
$servername="localhost";
$username="id13646820_root";
$password="Zendra@12345";
$dbname="id13646820_iot";


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        
            
           
        die("Database Connection failed: " . $conn->connect_error);
        echo "<a href='install.php'>If first time running click here to install database</a>";
    }

    $sql = "SELECT * FROM logs ORDER BY id DESC";
    if ($result=mysqli_query($conn,$sql))
    {
             
      $row=mysqli_fetch_row($result);
 
      if ($row[1]>50 && $row[1]<=100){
           $color_good = 'white';
            $backcolor_good = 'green';
            $color_mod = '#ffbf00';
          $color_unhealthy = '#800080';
      $color_poor = '#ff00ff';
    
           $color_severe = ' #e65c00;';
      
          
           $color_hazard = '#e62e00';
             $var = 'Moderate';
            $var = 'Good';
      }
       if ($row[1]>100 && $row[1]<=150){
           $color_mod = 'white';
            $backcolor_mod = '#ffbf00';
            
               $color_good = 'green';
            $color_unhealthy = '#800080';
      $color_poor = '#ff00ff';
    
           $color_severe = ' #e65c00;';
      
          
           $color_hazard = '#e62e00';
             $var = 'Moderate';


            

      }
       if ($row[1]>150 && $row[1]<=200){
           $color_poor = 'white';
            $backcolor_poor = '#ff00ff';
            $color_good = 'green';

            $color_mod = '#ffbf00';
            
            $color_unhealthy = '#800080';
      
    
           $color_severe = ' #e65c00;';
      
          
           $color_hazard = '#e62e00';

            $var = 'Poor';


           
           
      }
       if ($row[1]>200 && $row[1]<=300){
           $color_unhealthy = 'white';
            $backcolor_unhealthy = '#800080';
             $var = 'Unhealthy';

      }
       if ($row[1]>300 && $row[1]<=400){
           $color_severe = 'white';
           $backcolor_severe = ' #e65c00;';
            $var = 'Severe';

      }
       if ($row[1]>400 && $row[1]<=500){
           $color_hazard = 'white';
           $backcolor_hazard = '#e62e00';
             $var = 'Hazardous';

      }
      
	 mysqli_free_result($result);
    }

    mysqli_close($conn);
?> 

<div class="red">
<div class="card">

<div class="container">
 
<h1 class="text">AQI MONITORING SYSTEM</h1>
<a href= "table.php" style="float: right;">View Table</a>
</div>
<div class="aqi">
  <span>Current AQI Index</span>
  <h2 style=" color: #252525; font-family: 'Barlow'; top: 70px; left: 280px; position: absolute; font-size: 110px;"><?php
     echo $row[1];
?></h2>
  <strong><span style=" color: #464444; font-family: 'Barlow'; top: 180px; left: 300px; font-size: 35px; position: absolute;"
  > <?php echo $var; ?></span></strong>
</div>

<div class="box1">
  <div class="box2" style="color: <?php echo $color_good; ?>; background-color : <?php echo $backcolor_good; ?>">
      <p>Good<br> <span>51-100</span>
      </div>
      <div class="box2" style="color: <?php echo $color_mod; ?>; background-color : <?php echo $backcolor_mod; ?>">
          <p>Moderate<br> <span>101-150</span>
          </p>
          </div>
          <div class="box2" style="color: <?php echo $color_poor; ?>; background-color : <?php echo $backcolor_poor; ?>">
              <p>Poor<br><span>151-200</span></p>
              </div>

              <div class="box2" style="color: <?php echo $color_unhealthy; ?>; background-color : <?php echo $backcolor_unhealthy; ?>">
                  <p>Unhealthy<br><span>201-300</span></p>
                  </div>

                  <div class="box2" style="color: <?php echo $color_severe; ?>; background-color : <?php echo $backcolor_severe; ?>">
                      <p>Severe<br><span>301-400</span></p>
                      </div>
                      <div class="box2" style="color: <?php echo $color_hazard; ?>; background-color : <?php echo $backcolor_hazard; ?>">
                          <p>Hazardous<br><span>401-500</span></p>
                          </div>
</div>
<br><br>

<span style="margin-left: 40px;">PM/2.5 (mg/m<sup>3</sup>)<span style= "position: absolute; left: 410px;"><?php
    echo $row[4];
?></span></span>
<div class="progress" style="height:10px; width: 80% ; margin-left: 40px; ">
  <div class="progress-bar" style="width:  <?php
    echo ($row[4]*50) ?>%;height:10px"></div>
</div>
<br>
<span style="margin-left: 40px;">Humidity(%)<span style= "position: absolute; left: 410px;"><?php
    echo $row[3];
?></span></span>
<div class="progress" style="height:10px; width: 80%; margin-left: 40px;">
<div class="progress-bar" style="width: <?php
    echo $row[3];
?>%;height:10px"></div>
</div>
<br>
<span style="margin-left: 40px;">Temperature(°C)<span style= "position: absolute; left: 410px;"><?php
    echo $row[2];
?></span></span>
<div class="progress" style="height:10px; width: 80%; margin-left: 40px;">
<div class="progress-bar" style="width: <?php
    echo ($row[2]*2) ?>%;;height:10px"></div>
</div>
</div>
</div>

</div>
</body>
</html>