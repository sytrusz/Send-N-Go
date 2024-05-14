<?php
session_start();
if (!isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: display.php");
    exit;
}

$connect = mysqli_connect("localhost", "root", "", "sendngo") or die("Unable to connect");

$id = $_GET['id'];
$query = "DELETE FROM supplier WHERE SupplierID=?";
$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
$success = mysqli_stmt_execute($stmt);

if ($success) {
    $_SESSION['delete_message'] = "Record deleted successfully";
    echo "<script language='javascript'>
          alert('Record deleted successfully');
          window.location.href='display.php';
          </script>";
} else {
    $_SESSION['delete_message'] = "Failed to delete record";
    echo "<script language='javascript'>
          alert('Failed to delete record');
          window.location.href='display.php';
          </script>";
}
exit;
?>