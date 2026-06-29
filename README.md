# Customer Segmentation Using RFM Analysis

## Overview

This project performs customer segmentation using RFM Analysis to help businesses identify and target different customer groups effectively.

---

## What is RFM Analysis?

RFM stands for **Recency, Frequency, Monetary** - three key metrics that describe customer behavior:

- **Recency (R)**: How recently did the customer make a purchase? (days since last order)
- **Frequency (F)**: How often does the customer purchase? (total number of orders)
- **Monetary (M)**: How much money has the customer spent? (total spending)

---

## Customer Segments

Based on RFM scores, customers are classified into:

1. **High Value Customers**: Recent purchasers, frequent buyers, high spending
2. **Loyal Customers**: Consistent purchase frequency over time
3. **At Risk Customers**: Haven't purchased in a long time (high recency)
4. **Regular Customers**: All others

---

## Project Structure

```
customer-segmentation-rfm-sql/
│
├── README.md
├── sql/
│   ├── create_table.sql
│   ├── insert_data.sql
│   └── rfm_analysis.sql
└── screenshots/
    ├── transactions.png
    ├── rfm_output.png
    └── segments.png
```

---

## Technologies Used

- **SQL** - Data analysis and segmentation
- **MySQL** - Database management
- **GitHub** - Version control and portfolio

---

## How to Use

1. Run `sql/create_table.sql` to create the database
2. Run `sql/insert_data.sql` to load sample data
3. Run `sql/rfm_analysis.sql` to generate customer segments

---

## Business Impact

- Identify high-value customers for premium services
- Detect loyal customers for retention programs
- Flag at-risk customers for re-engagement campaigns
- Enable data-driven marketing strategies
