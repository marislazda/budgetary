<?php

namespace App\Repositories;

use DB;

class ProductsRepository {

    public function getProductMappingName(string $originalName):? string
    {
        $result = DB::table('products_mapping')
            ->where('original_product', 'like', '%' . $originalName . '%')
            ->first();

        return $result ? $result->product : null;
    }

    public function getProductType(string $product): int
    {
        $result = DB::table('purchases')
            ->where('product', $product)
            ->orderByDesc('id')
            ->first();

        return $result ? $result->type_id : 0;
    }

}
