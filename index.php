<?php
  session_start();
  $con = mysqli_connect("localhost", "root", "", "sendngo") or die("Error in connection");
  echo "connected";

  if (!isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit;
	}

  $con = mysqli_connect("localhost", "root", "", "sendngo") or die("Error in connection");

	if($_SESSION['uname'] == "")
		header("location: login.php");

	if (isset($_SESSION['count'])) {
		$_SESSION['count'] += 1;
	} else {
		$_SESSION['count'] = 1;
	}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link href="style/index.css" type="text/css" rel="stylesheet"/>
  <title>Main Page</title>
  
  <script type="text/javascript">
    function confirmLogout() {
        var result = confirm("Are you sure you want to logout?");
        if (result) {
            window.location.href = 'logout.php';
        }
    }
    </script>
</head>
<body>
  <div class="main">
    <h2>Main Page</h2><br>
    Hello, <b><?php echo $_SESSION['uname']; ?></b><br>
    Your session count is: <?php echo $_SESSION['count']; ?><br>
	<hr /><br>
    <a href="insert.php">Insert Row</a><br>
    <a href="display.php">Display</a><br>
    <a href="#" onclick="confirmLogout()">Logout</a>
  </div>
</body>
</html>