<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM transactions WHERE id='$id'";

if(mysqli_query($conn, $sql))
{
    header("Location: transactions.php");
}
else
{
    echo "Error deleting transaction.";
}

mysqli_close($conn);
?>