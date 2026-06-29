<!DOCTYPE html>
<html>
<head>
    <title>Add Transaction</title>
<link rel="stylesheet" href="assets/css/style.css"></head>

<body>

<h1>Add New Transaction</h1>

<form action="save_transaction.php" method="POST">

    <label>Customer ID</label><br>
    <input type="text" name="customer_id" required><br><br>

    <label>Customer Name</label><br>
    <input type="text" name="customer_name" required><br><br>

    <label>Order Date</label><br>
    <input type="date" name="order_date" required><br><br>

    <label>Amount</label><br>
    <input type="number" step="0.01" name="amount" required><br><br>

    <button type="submit">Save Transaction</button>

</form>

<br>

<a href="index.php">
    <button>Back to Dashboard</button>
</a>

</body>
</html>