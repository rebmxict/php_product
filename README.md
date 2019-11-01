# Store Inventory

You are managing the inventory of a small sweet store that sells 5 products:
Brownie, Lamington, Blueberry Muffin, Croissant, Chocolate Cake 

```php
class Products
{
	public const BROWNIE = 1;
	public const LAMINGTON = 2;
	public const BLUEBERRY_MUFFIN = 3;
	public const CROISSANT = 4;
	public const CHOCOLATE_CAKE = 5;
}
```

For each product you will be required to track:
 
  - the total units sold
  - the total units purchased and pending
  - the total units purchased and received
  - the current stock levels 

Initially each product will start with a stock level of 20 units.
Every day for one week you will receive a list of orders with quantities to order for each product.
If any orders cannot be fulfilled because there is no stock for a single item on that order, the whole order shall be rejected.

A sample json file of orders for each day is provided as `orders-sample.json`, 
and you'll need to use this as a basis for receiving and processing daily orders. 

It is in the following format:

```javascript
[
	// Monday orders
	[ 
		// Brownie: 2, Lamington: 1
		{"1": 2, "2": 1},
		// Blueberry Muffin: 1, Chocolate cake: 1
		{"3": 1, "5": 1}
	],
	// Tuesday orders
	[ 
		// Croissant: 3
		{"4": 3},
		// Brownie: 3, Blueberry Muffin: 2, Chocolate cake: 2
		{"1": 3, "3": 2, "5": 2}
	]
	// Other days orders...
]
```

At the end of each days orders, if stock level for any product falls below 10, a purchase order will need to be created to replenish the low stock items.
For each low stock item you will need to purchase 20 units, though those 20 units will not be received and added to the store inventory until the start of the second days trade from when the purchase order was placed.

For example if the stock for Lamingtons at the end of Monday is 8 units, a purchase order for 20 units is made that night, which would be expected to be received by start of trading for Wednesday.
On Tuesday 5 Lamingtons are sold bringing the inventory down to 3 units. Lamingtons should not be added to a purchase order for that night as a pending purchase order is due the next morning.
A purchase order is then received for 20 Lamingtons before start of trading on Wednesday, topping inventory up to 23 units.

So one trading day would include the following events:

 - Receive stock for any pending purchase orders made 2 days prior
 - Process all orders for that day
 - Place purchase order for all products low in stock (excluding items in a pending purchase order)

The program needs to output a summary after 7 days of trading for each product:

 - The total units sold
 - The total units purchased and pending
 - The total units purchased and received
 - The current stock level
 
It would be preferable to just output to the terminal in a nicely formatted ascii table.
When processing the included `orders-sample.json` your results should match the following numbers.

```
> php index.php

+----------------------------------------------------------+
| Product              | Sold | Received | Pending | Stock |
| -------------------- | ---- | -------- | ------- | ----- |
| (1) Brownie          |   51 |       40 |      20 |     9 |
| (2) Lamington        |   38 |       20 |      20 |     2 |
| (3) Blueberry Muffin |   28 |       20 |       0 |    12 |
| (4) Croissant        |   24 |       20 |       0 |    16 |
| (5) Chocolate Cake   |   29 |       20 |       0 |    11 |
+----------------------------------------------------------+
```
 
## Provided Interfaces

For your solution there are four Php interfaces you must implement
 
`src/OrderProcessorInterface.php` Class to process orders and output a summary

`src/InventoryInterface.php` Class to manage inventory and track stock levels

`src/ProductsSoldInterface.php` Track total products sold for whole week

`src/ProductsPurchasedInterface.php` Track total products purchased for whole week

You may add methods to the interfaces as you see fit, but please do not change the provided methods

## Notes

Please clone this repository and provide your solution preferably under your own github account.

Minimum of PHP 7.1

Please consider relevant error handling and validation, documentation for your code, and adding comments where helpful.  

Also add any relevant unit tests using whatever Php unit test framework you prefer.

If you're project needs any dependencies please use [Composer](https://getcomposer.org/).

Its up to you if you wish to include any utility libraries.

Though to keep things simple you should not use any Php frameworks, or databases to store stock levels, everything should be stored in memory at runtime. 
