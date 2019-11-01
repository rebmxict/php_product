<?php

interface ProductsSoldInterface
{
    /**
     * @param int $productId
     * @return int
     */
    public function getSoldTotal(int $productId): int;
}
