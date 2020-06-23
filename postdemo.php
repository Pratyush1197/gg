<?php
//Creates new record as per request
    //Connect to database
$servername="localhost";
$username="root";
$password="";
$dbname="id12721410_amit";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }

    //Get current date and time
    date_default_timezone_set('Asia/Kolkata');
    $d = date("Y-m-d");
    //echo " Date:".$d."<BR>";
    $t = date("H:i:s");

    if( !empty($_POST['aqipost'] && !empty($_POST['temppost']) && !empty($_POST['hrvpost']) && !empty($_POST['dustdenpost']) )
    {
        $var1 = $_POST['aqipost'];
        $var2 = $_POST['temppost'];
        $var3 = $_POST['hrvpost'];
        $var4 = $_POST['dustdenpost']

        $sql = "INSERT INTO logs (station, status, Date, Time)
        
        VALUES ('".$var1."', '".$var2."', '".$var3."','".$var4."','".$d."', '".$t."')";

        if ($conn->query($sql) === TRUE) {
            echo "OK";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }


    $conn->close();
?>