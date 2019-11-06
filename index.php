<?php

require_once('src/InventoryInterface.php');
require_once('src/OrderProcessorInterface.php');
require_once('src/Products.php');
require_once('src/ProductsPurchasedInterface.php');
require_once('src/ProductsSoldInterface.php');

$orderProcessor = new OrderProcessor();
$orderProcessor->processFromJson("orders-sample.json");
$orderData = $orderProcessor->orderData;
$orderData = json_decode($orderData, true);

$inventory = new Inventory();
$productsSold = new ProductsSold();

if(is_array($orderData)) {
	foreach ($orderData as $orders) {
		$dayInventoryData = '';
		$dayInventoryData = json_decode($dayInventoryData);
		$dayInventoryData["1"] = 0;
		$dayInventoryData["2"] = 0;
		$dayInventoryData["3"] = 0;
		$dayInventoryData["4"] = 0;
		$dayInventoryData["5"] = 0;
		foreach ($orders as $order) {
			foreach ($order as $key => $value) {
				$dayInventoryData[(string) $key] += $value;
			}
		}

		$inventory->updateStockPurchase($dayInventoryData, "morning");
		if($inventory->checkStockLevel($dayInventoryData)) {
			$inventory->updateStockLevel($dayInventoryData);
			foreach ($dayInventoryData as $key => $value) {
				$productsSold->soldTotal[$key] += $value;
			}
		}
		$inventory->updateStockPurchase($dayInventoryData, "evening");
	}
}

for ($i = 1; $i <= 5; $i ++) {
	echo $i . " " . $productsSold->getSoldTotal($i) .  " " . $inventory->productsPurchased->getPurchasedReceivedTotal($i) . " "
		. $inventory->productsPurchased->getPurchasedPendingTotal($i) . " " . $inventory->getStockLevel($i) . "\n";
}

?>