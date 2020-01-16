<?php
$connect = mysqli_connect("localhost","next", "nextTeam2","nextDocumentManager");

if (!$connect) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die(mysqli_error());
}

//Using POST
$var_value = $_GET['approveID'];


$sql = "UPDATE documents SET Approved=TRUE WHERE ID=$var_value";
mysqli_query($connect, $sql);

header("Location: adminindex.php");
?>
