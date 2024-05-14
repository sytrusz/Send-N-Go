<?php
session_start();
if (!isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit;
}

$connect = mysqli_connect("localhost", "root", "", "sendngo") 
or die("Unable to connect");

$sql = "SELECT * FROM supplier";
$result = mysqli_query($connect, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="style/display.css" type="text/css" rel="stylesheet"/>
    <title>Display Table</title>
</head>
<body>
    <h3 class="head">Data Table</h3>

    <div class="formBG">
    <table class="table-fill">
        <thead>
            <tr>
                <th class="text-left">SupplierID</th>
                <th class="text-left">Name</th>
                <th class="text-left">Street</th>
                <th class="text-left">City</th>
                <th class="text-left">Province</th>
                <th class="text-left">Password</th>
                <th class="text-left">Action</th>
            </tr>
        </thead>

        <tbody class="table-hover">
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="text-left"><?php echo $row['SupplierID']; ?></td>
                    <td class="text-left"><?php echo $row['Name']; ?></td>
                    <td class="text-left"><?php echo $row['Street']; ?></td>
                    <td class="text-left"><?php echo $row['City']; ?></td>
                    <td class="text-left"><?php echo $row['Province']; ?></td>
                    <td class="text-left"><?php echo $row['password']; ?></td>
                    <td class="text-left">
                        <a href="update.php?id=<?php echo $row['SupplierID']; ?>">Update</a>
                        <a href="delete.php?id=<?php echo $row['SupplierID']; ?>"onclick="
                        return confirm('Are you sure you want to delete this record?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table><br>
    
    <br />
    <a href="main.php">Return to Main</a>
    </div>
</body>
</html>