# Acme Widget Co - Interactive Basket

## Overview

This is a simple PHP console program for a shopping basket.  
You can type in product codes, and it will calculate the total, including discounts and delivery.

## Products

| Name         | Code | Price   |
|--------------|------|---------|
| Red Widget   | R01  | $32.95  |
| Green Widget | G01  | $24.95  |
| Blue Widget  | B01  | $7.95   |

## Delivery Charges

- Orders under $50: $4.95
- Orders $50 or more, but less than $90: $2.95
- Orders $90 or more: Free

## Special Offer

- Buy one Red Widget (R01), get the second half price.

## How to Use

1. **Make sure you have PHP installed.**  
   You can check by running `php -v` in your terminal.

2. **Save the code in a file called `basket.php`.**

3. **Open a terminal and run:**
   ```
   php basket.php
   ```

4. **When prompted, type product codes separated by spaces.**  
   For example:
   ```
   R01 G01 B01
   ```
   Then press Enter.

5. **You will see a summary like:**
   ```
   --- Basket Summary ---
   Subtotal: $65.85
   Discounts: -$0.00
   Delivery: $2.95
   Total: $68.80
   ```

   If you enter two R01s, you’ll see the discount applied:
   ```
   R01 R01
   ```

   Output:
   ```
   --- Basket Summary ---
   Subtotal: $65.90
   Discounts: -$16.48 (Red Widget offer x1)
   Delivery: $4.95
   Total: $54.37
   ```

## Example Baskets

| Input                  | Total   |
|------------------------|---------|
| B01 G01                | $37.85  |
| R01 R01                | $54.37  |
| R01 G01                | $60.85  |
| B01 B01 R01 R01 R01    | $98.27  |

## Notes

- If you enter an unknown product code, the program will warn you and skip it.
- You can edit the code to add more products or change prices if you wish.

---
