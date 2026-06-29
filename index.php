<?php
include 'db.php';

// Total Customers
$customerQuery = "SELECT COUNT(DISTINCT customer_id) AS total_customers FROM transactions";
$customerResult = mysqli_query($conn, $customerQuery);
$totalCustomers = mysqli_fetch_assoc($customerResult)['total_customers'];

// Total Revenue
$revenueQuery = "SELECT SUM(amount) AS total_revenue FROM transactions";
$revenueResult = mysqli_query($conn, $revenueQuery);
$totalRevenue = mysqli_fetch_assoc($revenueResult)['total_revenue'];

// Total Transactions
$transactionQuery = "SELECT COUNT(*) AS total_transactions FROM transactions";
$transactionResult = mysqli_query($conn, $transactionQuery);
$totalTransactions = mysqli_fetch_assoc($transactionResult)['total_transactions'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Customer Segmentation Dashboard</title>
<link rel="stylesheet" href="assets/css/style.css"></head>

<body>

<h1>Customer Segmentation Dashboard</h1>

<div class="cards">

    <div class="card">
        <h2><?php echo $totalCustomers; ?></h2>
        <p>Total Customers</p>
    </div>

    <div class="card">
        <h2>₹<?php echo $totalRevenue; ?></h2>
        <p>Total Revenue</p>
    </div>

    <div class="card">
        <h2><?php echo $totalTransactions; ?></h2>
        <p>Total Transactions</p>
    </div>

</div>

<br><br>

<a href="add_transaction.php">
<button>Add Transaction</button>
</a>

<a href="transactions.php">
<button>View Transactions</button>
</a>

<a href="rfm_analysis.php">
<button>RFM Analysis</button>
</a>

</body>

</html>