<?php

$uname = $_POST['uname'];
$email  = $_POST['email'];
$numbr = $_POST['numbr'];
$venu = $_POST['venu'];
$mesg = $_POST['mesg'];
$guest = $_POST['guest'];



if (!empty($uname) || !empty($email) || !empty($numbr) || !empty($venu)|| !empty($mesg)|| !empty($guest) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "form";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From contact Where email = ? Limit 1";
  $INSERT = "INSERT Into contact (uname , email ,numbr, venu,mesg,guest)values(?,?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssssi", $uname,$email,$numbr,$venu,$mesg,$guest);
      $stmt->execute();
      echo "New record inserted sucessfully";

     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>