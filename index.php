<?php

require_once('src/InventoryInterface.php');
require_once('src/OrderProcessorInterface.php');
require_once('src/Products.php');
require_once('src/ProductsPurchasedInterface.php');
require_once('src/ProductsSoldInterface.php');

class Manager
{
	public $orderProcessor;
	public $orderData;
	public $inventory;
	public $productsSold;

	public function __construct() {
		$this->orderProcessor = new OrderProcessor();
		$this->orderProcessor->processFromJson("orders-sample.json");
		$this->orderData = $this->orderProcessor->orderData;
		$this->orderData = json_decode($this->orderData, true);

		$this->inventory = new Inventory();
		$this->productsSold = new ProductsSold();
	}

	public function manage() {
		if(is_array($this->orderData)) {
			foreach ($this->orderData as $orders) {
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

				$this->inventory->updateStockPurchase($dayInventoryData, "morning");
				if($this->inventory->checkStockLevel($dayInventoryData)) {
					$this->inventory->updateStockLevel($dayInventoryData);
					foreach ($dayInventoryData as $key => $value) {
						$this->productsSold->soldTotal[$key] += $value;
					}
				}
				$this->inventory->updateStockPurchase($dayInventoryData, "evening");
			}
		}

		for ($i = 1; $i <= 5; $i ++) {
			echo $i . " " . $this->productsSold->getSoldTotal($i) .  " "
				. $this->inventory->productsPurchased->getPurchasedReceivedTotal($i) . " "
				. $this->inventory->productsPurchased->getPurchasedPendingTotal($i) . " "
				. $this->inventory->getStockLevel($i) . "\n";
		}
	}
}

$manager = new Manager();
$manager->manage();

?>