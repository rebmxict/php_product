<?php

interface ProductsPurchasedInterface
{
	/**
	 * @param int $productId
	 * @return int
	 */
	public function getPurchasedReceivedTotal(int $productId): int;

	/**
	 * @param int $productId
	 * @return int
	 */
	public function getPurchasedPendingTotal(int $productId): int;
}

class ProductsPurchased implements ProductsPurchasedInterface
{
	public $receivedTotal = '';
	public $pendingTotal = '';

	public function __construct() {
		$this->receivedTotal = json_decode($this->receivedTotal);
		$this->receivedTotal["1"] = 0;
		$this->receivedTotal["2"] = 0;
		$this->receivedTotal["3"] = 0;
		$this->receivedTotal["4"] = 0;
		$this->receivedTotal["5"] = 0;
		$this->pendingTotal = json_decode($this->pendingTotal);
		$this->pendingTotal["1"] = 0;
		$this->pendingTotal["2"] = 0;
		$this->pendingTotal["3"] = 0;
		$this->pendingTotal["4"] = 0;
		$this->pendingTotal["5"] = 0;
	}

	public function getPurchasedReceivedTotal(int $productId): int {
		return $this->receivedTotal[(string)$productId];
	}

	public function getPurchasedPendingTotal(int $productId): int {
		return $this->pendingTotal[(string)$productId];
	}
}