<?php

interface InventoryInterface
{
    /**
     * @param int $productId
     * @return int
     */
    public function getStockLevel(int $productId): int;
}
