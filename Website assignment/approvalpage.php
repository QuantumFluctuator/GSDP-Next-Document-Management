<?php
$connect = mysqli_connect("localhost","next", "nextTeam2","nextDocumentManager");

if (!$connect) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die(mysqli_error());
}

//Using POST
$var_value = $_POST['approveID'];

$sql = "UPDATE documents SET Approved='Yes' WHERE ID='approveID'";
header("Location: adminindex.php");
?>
