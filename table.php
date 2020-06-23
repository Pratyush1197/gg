



<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" content="2">
</head>
<body>
<style>
#c4ytable {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#c4ytable td, #c4ytable th {
    border: 1px solid #ddd;
    padding: 8px;
}

#c4ytable tr:nth-child(even){background-color: #f2f2f2;}

#c4ytable tr:hover {background-color: #ddd;}

#c4ytable th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #00A8A9;
    color: white;
}
</style>

<h1>Created by- Arpit, Siddharth, Pratyush, Shivam</h1>
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
?> 


<div id="cards" class="cards">

<?php 
    $sql = "SELECT * FROM logs ORDER BY id DESC";
    if ($result=mysqli_query($conn,$sql))
    {
      // Fetch one and one row
      echo "<TABLE id='c4ytable'>";
      echo "<TR><TH>Sr.No.</TH><TH>Air Quality (ppm)</TH><TH>Temperature (celcius)</TH><TH>Humidity (%)</TH><TH>Dustdensity (mg/metre-cube)</TH><TH>Date</TH><TH>Time</TH></TR>";
      while ($row=mysqli_fetch_row($result))
      {
        echo "<TR>";
        echo "<TD>".$row[0]."</TD>";
        echo "<TD>".$row[1]."</TD>";
        echo "<TD>".$row[2]."</TD>";
        echo "<TD>".$row[3]."</TD>";
        echo "<TD>".$row[4]."</TD>";
        echo "<TD>".$row[5]."</TD>";
        echo "<TD>".$row[6]."</TD>";
        
        
        echo "</TR>";
      }
      echo "</TABLE>";
      // Free result set
      mysqli_free_result($result);
    }

    mysqli_close($conn);
?>
<h2>To visit homepage click back button in browser</h2>
</body>
</html>