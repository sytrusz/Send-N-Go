<?php
session_start();
if (!isset($_SESSION['uname'])) {
  header("Location: login.php");
  exit;
}

$con= mysqli_connect("localhost","root","","sendngo") 
    or die("Error in connection");

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM supplier WHERE SupplierID = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($res);

    if(!$row) {
        echo "Invalid SupplierID provided.";
        exit;
    }
} else {
    echo "No SupplierID provided.";
    exit;
}

if (isset($_POST['btnUpdate'])) {
    $supplierID = $_POST['txtSupplierID'];
    $uname = $_POST['txtUname'];
    $street = $_POST['txtStreet'];
    $city = $_POST['txtCity'];
    $province = $_POST['txtProvince'];
    $pwd = $_POST['txtPwd'];

    $sql = "UPDATE supplier SET SupplierID=?, Name=?, Street=?, City=?, Province=?, password=? WHERE SupplierID=?";
    $updateStmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($updateStmt, 'isssssi', $supplierID, $uname, $street, $city, $province, $pwd, $id);
    mysqli_stmt_execute($updateStmt);

    if (mysqli_stmt_affected_rows($updateStmt) > 0) {
        echo "<script language='javascript'>
              alert('Record updated successfully');
              </script>";
    } else {
        echo "<script language='javascript'>
              alert('Failed to update record');
              </script>";
    }
    mysqli_stmt_close($updateStmt);
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  
  <link href="style/insert.css" type="text/css" rel="stylesheet"/>
  <title>Update Data</title>
</head>

<body>
<h2>Insert Row</h2>
  <div class="formBG">
    <form action="update.php?id=<?php echo $id; ?>" method="POST">
      <div class="floating-placeholder">
        <input id="txtSupplierID" type="text" name="txtSupplierID" placeholder="SupplierID" value="<?php echo $row['SupplierID']; ?>" required>
        <label for="txtSupplierID">SupplierID</label>
      </div>
      <div class="floating-placeholder">
        <input id="txtUname" type="text" name="txtUname" placeholder="Name" value="<?php echo $row['Name']; ?>" required>
        <label for="txtUname">Name</label>
      </div>
      <div class="floating-placeholder">
        <input id="txtStreet" type="text" name="txtStreet" placeholder="Street" value="<?php echo $row['Street']; ?>" required>
        <label for="txtStreet">Street</label>
      </div>
      <div class="floating-placeholder">
        <input id="txtCity" type="text" name="txtCity" placeholder="City" value="<?php echo $row['City']; ?>" required>
        <label for="txtCity">City</label>
      </div>
      <div class="floating-placeholder">
        <input id="txtProvince" type="text" name="txtProvince" placeholder="Province" value="<?php echo $row['Province']; ?>" required>
        <label for="txtProvince">Province</label>
      </div>
      <div class="floating-placeholder">
        <input id="txtPwd" type="password" name="txtPwd" placeholder="Password" value="<?php echo $row['password']; ?>" required>
        <label for="txtPwd">Password</label>
      </div>
      <div class="inputBx">
        <input type="submit" name="btnUpdate" value="Update">
      </div>
    </form>
    <br />
    <a href="display.php">Return to Display</a>
  </div>
</body>
</html>