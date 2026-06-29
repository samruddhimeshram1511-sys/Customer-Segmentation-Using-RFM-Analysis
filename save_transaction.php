<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $customer_id = trim($_POST['customer_id']);
    $customer_name = trim($_POST['customer_name']);
    $order_date = $_POST['order_date'];
    $amount = $_POST['amount'];

    // Check if any field is empty
    if (empty($customer_id) || empty($customer_name) || empty($order_date) || empty($amount)) {
        die("<h2>❌ Please fill all the fields.</h2>
        <br><a href='add_transaction.php'>Go Back</a>");
    }

    // Insert data
    $sql = "INSERT INTO transactions (customer_id, customer_name, order_date, amount)
            VALUES ('$customer_id', '$customer_name', '$order_date', '$amount')";

    if (mysqli_query($conn, $sql)) {

        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Success</title>

            <style>

                body{
                    font-family:Arial;
                    background:#f4f6f9;
                    text-align:center;
                    padding-top:100px;
                }

                .box{

                    width:500px;
                    margin:auto;
                    background:white;
                    padding:40px;
                    border-radius:10px;
                    box-shadow:0px 0px 15px rgba(0,0,0,.2);

                }

                a{

                    text-decoration:none;
                    color:white;
                    background:#3498db;
                    padding:12px 25px;
                    border-radius:5px;
                    margin:10px;
                    display:inline-block;

                }

                a:hover{

                    background:#2980b9;

                }

            </style>

        </head>

        <body>

            <div class='box'>

                <h1>✅ Transaction Saved Successfully!</h1>

                <p>The transaction has been added to the database.</p>

                <a href='add_transaction.php'>Add Another Transaction</a>

                <a href='transactions.php'>View Transactions</a>

                <a href='index.php'>Dashboard</a>

            </div>

        </body>

        </html>

        ";

    } else {

        echo "<h2>Error:</h2> " . mysqli_error($conn);

    }

} else {

    header("Location: add_transaction.php");

}

mysqli_close($conn);
?>