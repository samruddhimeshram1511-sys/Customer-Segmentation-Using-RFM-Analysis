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

// Average Order Value
$averageOrder = ($totalTransactions > 0) ? ($totalRevenue / $totalTransactions) : 0;

// Champion Customers
$championQuery = "
SELECT COUNT(*) AS champions
FROM (
    SELECT
        customer_id,
        DATEDIFF(CURDATE(), MAX(order_date)) AS recency,
        COUNT(*) AS frequency,
        SUM(amount) AS monetary
    FROM transactions
    GROUP BY customer_id
) rfm
WHERE recency <= 30
AND frequency >= 5
AND monetary >= 10000";

$championResult = mysqli_query($conn, $championQuery);
$champions = mysqli_fetch_assoc($championResult)['champions'];
// At Risk Customers
$atRiskQuery = "
SELECT COUNT(*) AS atrisk
FROM (
    SELECT
        customer_id,
        DATEDIFF(CURDATE(), MAX(order_date)) AS recency
    FROM transactions
    GROUP BY customer_id
) rfm
WHERE recency > 90";

$atRiskResult = mysqli_query($conn, $atRiskQuery);
$atRisk = mysqli_fetch_assoc($atRiskResult)['atrisk'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Segmentation Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{ 
            background:#f4f6f9;
        }

        .card{
            border:none;
            border-radius:15px;
        }

        .card h2{
            font-weight:bold;
        }

        .dashboard-title{
            font-weight:bold;
            color:#2c3e50;
        }

        .btn{
            border-radius:10px;
            padding:10px 20px;
        }

    </style>

</head>

<body>

<div class="container py-5">

    <h1 class="text-center dashboard-title mb-5">
        📊 Customer Segmentation Dashboard
    </h1>

    <div class="row">

        <!-- Customers -->
<div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                <div class="card shadow bg-primary text-white">
                <div class="card-body text-center">
                    <h5>👥 Customers</h5>
                    <h2><?php echo $totalCustomers; ?></h2>
                </div>
            </div>
        </div>

        <!-- Revenue -->
<div class="col-lg-2 col-md-4 col-sm-6 mb-4">
            <div class="card shadow bg-success text-white">
                <div class="card-body text-center">
                    <h5>💰 Revenue</h5>
                    <h2>₹<?php echo number_format($totalRevenue,2); ?></h2>
                </div>
            </div>
        </div>

        <!-- Transactions -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
            <div class="card shadow bg-warning text-dark">
                <div class="card-body text-center">
                    <h5>📦 Transactions</h5>
                    <h2><?php echo $totalTransactions; ?></h2>
                </div>
            </div>
        </div>

        <!-- Average Order -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
            <div class="card shadow bg-danger text-white">
                <div class="card-body text-center">
                    <h5>💳 Avg Order</h5>
                    <h2>₹<?php echo number_format($averageOrder,2); ?></h2>
                </div>
            </div>
        </div>

        <!-- At Risk Customers -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
            <div class="card shadow bg-info text-white">
                <div class="card-body text-center">
                    <h5>⚠️ At Risk</h5>
                    <h2><?php echo $atRisk; ?></h2>
                </div>
            </div>
        </div>

    </div>

    <!-- Champion Customers -->
<div class="col-lg-2 col-md-4 col-sm-6 mb-4">
    <div class="card shadow bg-dark text-white">
        <div class="card-body text-center">
            <h5>🏆 Champions</h5>
            <h2><?php echo $champions; ?></h2>
        </div>
    </div>
</div>

    <div class="text-center mt-4">

        <a href="add_transaction.php" class="btn btn-success m-2">
            ➕ Add Transaction
        </a>

        <a href="transactions.php" class="btn btn-primary m-2">
            📋 View Transactions
        </a>

        <a href="rfm_analysis.php" class="btn btn-warning m-2">
            📊 RFM Analysis
        </a>

    </div>

    <div class="mt-5">

        <div class="card shadow">
            <div class="card-body">

                <h4>📌 About This Dashboard</h4>

                <p>
                    This dashboard provides an overview of customer transactions and
                    RFM (Recency, Frequency, Monetary) analysis. It helps businesses
                    identify valuable customers and make data-driven decisions.
                </p>

            </div>
        </div>

    </div>

</div>

</body>

</html>