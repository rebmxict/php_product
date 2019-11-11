<?php
use PHPUnit\Framework\TestCase;

require 'index.php';

class KountaTest extends TestCase
{
	public $manager;

	function setUp() {
		$this->manager = new Manager();
		$this->manager->manage();
	}
	public function testSoldTotal() {
		$this->assertEquals($this->manager->productsSold->getSoldTotal(1), 29);
		$this->assertEquals($this->manager->productsSold->getSoldTotal(3), 12);
		$this->assertEquals($this->manager->productsSold->getSoldTotal(5), 16);
	}

	public function testPurchasedReceivedTotal() {
		$this->assertEquals($this->manager->inventory->productsPurchased->getPurchasedReceivedTotal(1), 20);
		$this->assertEquals($this->manager->inventory->productsPurchased->getPurchasedReceivedTotal(3), 20);
		$this->assertEquals($this->manager->inventory->productsPurchased->getPurchasedReceivedTotal(5), 20);
	}

	public function testPurchasedPendingTotal() {
		$this->assertEquals($this->manager->inventory->productsPurchased->getPurchasedPendingTotal(1), 0);
		$this->assertEquals($this->manager->inventory->productsPurchased->getPurchasedPendingTotal(3), 0);
		$this->assertEquals($this->manager->inventory->productsPurchased->getPurchasedPendingTotal(5), 0);
	}

	public function testStockLevel() {
		$this->assertEquals($this->manager->inventory->getStockLevel(1), 11);
		$this->assertEquals($this->manager->inventory->getStockLevel(3), 28);
		$this->assertEquals($this->manager->inventory->getStockLevel(5), 24);
	}
}
?>