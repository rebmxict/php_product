<?php

interface ProductsSoldInterface
{
	/**
	 * @param int $productId
	 * @return int
	 */
	public function getSoldTotal(int $productId): int;
}

class ProductsSold implements ProductsSoldInterface
{
	public $soldTotal = '';

	public function __construct() {
		$this->soldTotal = json_decode($this->soldTotal);
		$this->soldTotal["1"] = 0;
		$this->soldTotal["2"] = 0;
		$this->soldTotal["3"] = 0;
		$this->soldTotal["4"] = 0;
		$this->soldTotal["5"] = 0;
	}

	public function getSoldTotal(int $productId): int {
		return $this->soldTotal[(string)$productId];
	}
}