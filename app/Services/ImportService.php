<?php

namespace App\Services;

use App\Models\Purchase;
use App\Repositories\ProductsRepository;
use App\Services\DTO\PurchaseDTO;
use Exception;
use Illuminate\Http\UploadedFile;
use Spatie\PdfToText\Pdf;

class ImportService {

    private UploadedFile $file;
    private ProductsRepository $repositoryProducts;

    function __construct() {
        $this->repositoryProducts = new ProductsRepository;
    }

    /**
     * @param UploadedFile $file
     * @throws Exception
     */
    public function processFile(UploadedFile $file)
    {
        try {
            $this->file = $file;
            $products = $this->getFileContent();

            $products = $this->getProductMappingNames($products);
            $products = $this->getProductTypes($products);
            if ($products) {
                $this->savePurchases($products);
            }

        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Only MAXIMA. I will be ugly
     * @return array
     * @throws Exception
     */
    private function getFileContent(): array
    {
        $text = (new Pdf())
            ->setPdf($this->file->getPathname())
            ->text();

        $matches = [];

        preg_match_all("/Daudzum\/gab\.\n\n(.*)Pielāgotās atlaides.*Cena ar PVN.*Summa ar PVN\n\n(.*)Aplikts ar nodokli/ms", $text, $matches);
        if (empty($matches[1])) {
            throw new Exception("Can't read file");
        }

        $products = [];
        $rows = explode(PHP_EOL, $matches[1][0]);
        foreach ($rows as $key => $row) {
            if (preg_match('/^(\d+([\,]\d+)|([0-9]+)) (gab.|kg)/', $row) || empty($row)) {
                continue;
            }
            $product = new PurchaseDTO;
            $product->originalProduct = $row;

            $products[] = $product;
        }


        $pricesSplit = preg_split("#\n\s*\n#Uis", $matches[2][0]);
        $prices = explode("\n", $pricesSplit[3]);

        foreach ($prices as $key => $price) {
            $products[$key]->price = (float)str_replace(['€', ','], ['', '.'], $price);
        }

        return $products;
    }

    /**
     * @param PurchaseDTO[] $products
     * @return PurchaseDTO[]
     */
    private function getProductMappingNames(array $products): array
    {
        $mappings = $this->repositoryProducts->getProductMappings();

        foreach ($products as &$product) {
            $product->product = $this->getProductMappingName($product->originalProduct, $mappings);
        }

        return $products;
    }

    private function getProductMappingName(string $originalProduct, array $mappings):? string
    {
        foreach ($mappings as $mappingSearch => $mappingTarget) {
            if (strpos($originalProduct, $mappingSearch) !== false) {
                return $mappingTarget;
            }
        }

        return null;
    }

    /**
     * @param PurchaseDTO[] $products
     * @return PurchaseDTO[]
     */
    private function getProductTypes(array $products)
    {
        foreach ($products as &$product) {
            if ($product->product) {
                $product->type_id = $this->repositoryProducts->getProductType($product->product);
            }
        }
        return $products;
    }

    /**
     * @param PurchaseDTO[] $products
     */
    private function savePurchases(array $products): void
    {
        foreach ($products as $product) {
            $data = new Purchase;

            if (!$product->product) {
                $product->product = $product->originalProduct;
            }

            $product = (array)$product;
            $product['created_at'] = gmdate('Y-m-d');
            $data->fill($product);
            $data->save();
        }
    }
}
