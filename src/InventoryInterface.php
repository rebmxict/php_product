<?php

require_once('ProductsPurchasedInterface.php');

interface InventoryInterface
{
	/**
	 * @param int $productId
	 * @return int
	 */
	public function getStockLevel(int $productId): int;
	public function checkStockLevel($dayInventoryData);
	public function updateStockLevel($dayInventoryData);
	public function updateStockPurchase($dayInventoryData, $checkTime);
}

class Inventory implements InventoryInterface
{
	public $inventoryData = '';
	public $inventoryPending = '';
	public $productsPurchased;

	public function __construct() {
		$this->inventoryData = json_decode($this->inventoryData);
		$this->inventoryData["1"] = 20;
		$this->inventoryData["2"] = 20;
		$this->inventoryData["3"] = 20;
		$this->inventoryData["4"] = 20;
		$this->inventoryData["5"] = 20;
		$this->inventoryPending = json_decode($this->inventoryPending);
		$this->inventoryPending["1"] = 0;
		$this->inventoryPending["2"] = 0;
		$this->inventoryPending["3"] = 0;
		$this->inventoryPending["4"] = 0;
		$this->inventoryPending["5"] = 0;
		$this->productsPurchased = new ProductsPurchased();
	}

	public function getStockLevel(int $productId): int {
		return $this->inventoryData[(string)$productId];
	}

	public function checkStockLevel($dayInventoryData) {
		$isAble = True;
		foreach ($dayInventoryData as $key => $value) {
			if($this->inventoryData[(string)$key] < $dayInventoryData[(string)$key]) {
				$isAble = False;
			}
		}
		return $isAble;
	}

	public function updateStockLevel($dayInventoryData) {
		foreach ($dayInventoryData as $key => $value) {
			$this->inventoryData[(string)$key] -= $value;
		}
	}

	public function updateStockPurchase($dayInventoryData, $checkTime) {
		if($checkTime == "evening") {	
			foreach ($this->inventoryPending as $key => $value) {
				if($this->inventoryPending[(string)$key] == 1) {
					$this->inventoryPending[(string)$key] = 2;
					$this->productsPurchased->pendingTotal[(string)$key] = 20;
				} else if ($this->inventoryPending[(string)$key] == 0) {
					$this->productsPurchased->pendingTotal[(string)$key] = 0;
				}
			}
			foreach ($dayInventoryData as $key => $value) {
				if($this->inventoryData[(string)$key] < $dayInventoryData[(string)$key]) {
					if($this->inventoryPending[(string)$key] == 0) {
						$this->inventoryPending[(string)$key] = 1;
					}
				}
			}
			foreach ($this->inventoryData as $key => $value) {
				if($this->inventoryData[(string)$key] < 10 && $this->inventoryPending[(string)$key] == 0) {
					$this->inventoryPending[(string)$key] = 1;
				}
			}
		} else {
			foreach ($this->inventoryPending as $key => $value) {
				if($this->inventoryPending[(string)$key] == 2) {
					$this->inventoryPending[(string)$key] = 0;
					$this->inventoryData[(string)$key] += 20;
					$this->productsPurchased->receivedTotal[(string)$key] += 20;
				}
			}	
		}
	}
}