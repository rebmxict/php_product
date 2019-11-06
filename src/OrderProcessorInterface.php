<?php

interface OrderProcessorInterface
{
	/**
	 * This function receives the path of the json for all the orders of the week,
	 * processes all orders for the week,
	 * while keeping track of stock levels, units sold and purchased
	 * See `orders-sample.json` for example
	 *
	 * @param string $filePath
	 */

	public function processFromJson(string $filePath): void;
}

class OrderProcessor implements OrderProcessorInterface
{
	public $orderData;

	public function processFromJson(string $filePath): void {
		$this->orderData = file_get_contents($filePath);
	}
}