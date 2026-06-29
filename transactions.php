<?php
include 'db.php';

$sql = "SELECT * FROM transactions ORDER BY transaction_id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>All Transactions</title>
<link rel="stylesheet" href="assets/css/style.css"></head>

<body>

<h1>All Transactions</h1>

<table border="1" cellpadding="10" cellspacing="0" style="margin:auto; background:white;">

<tr>
    <th>ID</th>
    <th>Customer ID</th>
    <th>Customer Name</th>
    <th>Order Date</th>
    <th>Amount</th>
</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['transaction_id']; ?></td>

<td><?php echo $row['customer_id']; ?></td>

<td><?php echo $row['customer_name']; ?></td>

<td><?php echo $row['order_date']; ?></td>

<td>₹ <?php echo $row['amount']; ?></td>

</tr>

<?php
}
?>

</table>

<br>

<a href="index.php">
<button>Back to Dashboard</button>
</a>

</body>

</html>