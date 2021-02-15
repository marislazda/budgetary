<?php

namespace App\Repositories;

use DB;

class ProductsRepository {

    public function getProductType(string $product): int
    {
        $result = DB::table('purchases')
            ->where('product', $product)
            ->orderByDesc('id')
            ->first();

        return $result ? $result->type_id : 0;
    }

    public function getProductMappings(): array
    {
        $mapping = [];
        $results = DB::table('products_mapping')
            ->get();

        foreach ($results as $result) {
            $mapping[$result->original_product] = $result->product;
        }

        return $mapping;
    }

    public function getTypeIdByName(string $name): int
    {
        $result = DB::table('types')
            ->where('name', $name)
            ->first();

        return $result ? $result->id : 0;
    }
}
