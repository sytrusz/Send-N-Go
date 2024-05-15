<?php
  session_start();
  $con = mysqli_connect("localhost", "root", "", "sendngo") or die("Error in connection");
  echo "connected";

  if(isset($_POST['btnLogin'])){
    $uname = $_POST['txtUname'];
    $pwd = $_POST['txtPwd'];
    $sql = "SELECT Name, password FROM supplier WHERE Name='$uname'";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
    
    if($count == 0){
      echo "<script language='javascript'>
            alert('Username not existing.');
          </script>";
    } else {
      $row = mysqli_fetch_array($result);
      if($row[1] != $pwd) {
        echo "<script language='javascript'>
              alert('Incorrect password.');
            </script>";
      } else {
        $_SESSION['uname'] = $row[0];
        header("location: index.php");
      }
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link href="style/login.css" type="text/css" rel="stylesheet"/>
  <title>Login Page</title>
</head>
<body>
  <div class="login">
    <div class="login-triangle"></div>
    <h2 class="login-header">Log in</h2>
    <form class="login-container" action="login.php" method="POST">
      <p><input type="text" name="txtUname" placeholder="Name"></p>
      <p><input type="password" name="txtPwd" placeholder="Password"></p>
      <p><input type="submit" name="btnLogin" value="Log in"></p>
    </form>
  </div>
</body>
</html>