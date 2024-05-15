<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insert Data</title>
  <link href="style/insert.css" type="text/css" rel="stylesheet" />
</head>

<body>
<h2>Insert Row</h2>
  <div class="formBG">
    <form action="insert.php" method="POST">
      <div class="floating-placeholder">
        <input id="txtUname" type="text" name="txtUname" required>
        <label for="txtUname">Name</label>
      </div>
      <div class="floating-placeholder">
        <input id="txtStreet" type="text" name="txtStreet" required>
        <label for="txtStreet">Street</label>
      </div>
      <div class="floating-placeholder">
        <input id="txtCity" type="text" name="txtCity" required>
        <label for="txtCity">City</label>
      </div>
      <div class="floating-placeholder">
        <input id="txtProvince" type="text" name="txtProvince" required>
        <label for="txtProvince">Province</label>
      </div>
      <div class="floating-placeholder">
        <input id="txtPwd" type="password" name="txtPwd" required>
        <label for="txtPwd">Password</label>
      </div>
      <div class="inputBx">
        <input type="submit" name="btnAdd" value="Confirm">
      </div>
    </form>
    <br />
    <a href="index.php">Return to Main</a>
  </div>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['uname'])) {
  header("Location: login.php");
  exit;
}

$connect = mysqli_connect("localhost", "root", "", "sendngo") or die("Unable to connect");

if (isset($_POST['btnAdd'])) {
    $uname = $_POST['txtUname'];
    $street = $_POST['txtStreet'];
    $city = $_POST['txtCity'];
    $province = $_POST['txtProvince'];
    $pwd = $_POST['txtPwd'];

    $sql = "SELECT supplierID FROM supplier WHERE supplierID = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $exists = mysqli_num_rows($result);

    if ($exists == 0) {
        $insertSql = "INSERT INTO supplier (SupplierID, Name, Street, City, Province, password) VALUES (?, ?, ?, ?, ?, ?)";
        $insertStmt = mysqli_prepare($connect, $insertSql);
        mysqli_stmt_bind_param($insertStmt, "ssssss", $supplierID, $uname, $street, $city, $province, $pwd);
        $insertSuccess = mysqli_stmt_execute($insertStmt);

        if ($insertSuccess) {
            $_SESSION['username_recent'] = $uname;
            echo "<script language='javascript'>
                alert('New record added');
                </script>";
        } else {
            echo "<script language='javascript'>
                alert('Failed to add new record');
                </script>";
        }
    } else {
        echo "<script language='javascript'>
            alert('Record is already existing');
            </script>";
    }
}
?>