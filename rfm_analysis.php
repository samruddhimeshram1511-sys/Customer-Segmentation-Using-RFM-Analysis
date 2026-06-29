<?php
include 'db.php';

$sql = "
SELECT
    customer_id,
    customer_name,
    DATEDIFF(CURDATE(), MAX(order_date)) AS recency,
    COUNT(*) AS frequency,
    SUM(amount) AS monetary
FROM transactions
GROUP BY customer_id, customer_name
ORDER BY monetary DESC;
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>RFM Analysis</title>
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            text-align: center;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 30px;
        }

        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.15);
        }

        th {
            background: #3498db;
            color: white;
            padding: 12px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background: #f1f1f1;
        }

        .btn {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 25px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
        }

        .btn:hover {
            background: #2980b9;
        }

        .champion {
            color: green;
            font-weight: bold;
        }

        .loyal {
            color: blue;
            font-weight: bold;
        }

        .potential {
            color: orange;
            font-weight: bold;
        }

        .atrisk {
            color: red;
            font-weight: bold;
        }

        .lost {
            color: gray;
            font-weight: bold;
        }
    </style>

</head>

<body>

<h1>📊 RFM Customer Analysis</h1>

<table>

<tr>
    <th>Customer ID</th>
    <th>Customer Name</th>
    <th>Recency (Days)</th>
    <th>Frequency</th>
    <th>Monetary (₹)</th>
    <th>Customer Segment</th>
</tr>

<?php

while($row = mysqli_fetch_assoc($result))
{

    if ($row['recency'] <= 30 && $row['frequency'] >= 5 && $row['monetary'] >= 10000)
    {
        $segment = "<span class='champion'>🏆 Champion</span>";
    }
    elseif ($row['recency'] <= 60 && $row['frequency'] >= 3 && $row['monetary'] >= 5000)
    {
        $segment = "<span class='loyal'>💎 Loyal Customer</span>";
    }
    elseif ($row['recency'] <= 90)
    {
        $segment = "<span class='potential'>🌟 Potential Loyalist</span>";
    }
    elseif ($row['recency'] <= 180)
    {
        $segment = "<span class='atrisk'>⚠️ At Risk</span>";
    }
    else
    {
        $segment = "<span class='lost'>❌ Lost Customer</span>";
    }

?>

<tr>

    <td><?php echo $row['customer_id']; ?></td>

    <td><?php echo $row['customer_name']; ?></td>

    <td><?php echo $row['recency']; ?></td>

    <td><?php echo $row['frequency']; ?></td>

    <td>₹ <?php echo number_format($row['monetary'],2); ?></td>

    <td><?php echo $segment; ?></td>

</tr>

<?php
}
?>

</table>

<a href="index.php" class="btn">
⬅ Back to Dashboard
</a>

</body>
</html>