<?php

namespace App\Services\DTO;

class PurchaseDTO {

    public string $originalProduct;
    public ?string $product = null;
    public float $price;
    public ?int $type_id = 0;

}
