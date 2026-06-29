SELECT 
    customer_id,
    DATEDIFF(CURDATE(), MAX(order_date)) AS Recency,
    COUNT(transaction_id) AS Frequency,
    SUM(amount) AS Monetary,
    CASE 
        WHEN DATEDIFF(CURDATE(), MAX(order_date)) <= 30 
             AND COUNT(transaction_id) >= 2 
             AND SUM(amount) >= 1000 THEN 'High Value'
        WHEN COUNT(transaction_id) >= 3 THEN 'Loyal'
        WHEN DATEDIFF(CURDATE(), MAX(order_date)) > 60 THEN 'At Risk'
        ELSE 'Regular'
    END AS Segment
FROM transactions
GROUP BY customer_id
ORDER BY Monetary DESC;
