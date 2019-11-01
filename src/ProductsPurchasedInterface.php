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
