<?php

namespace App\Providers;


use App\Database\Eloquent\Crud;
use App\Models\Book;
use App\Models\DVD;
use App\Models\Furniture;
use App\Models\Product;

class ProductProvider {
    public static function createProduct($request): Crud
    {
        $newProduct = Product::create([
            'sku' => $request['sku'],
            'name' => $request['name'],
            'price' => $request['price'],
            'product_type' => $request['product_type']
        ]);

        $productId = $newProduct->getData()['id'];

        self::createProductType($request['product_type'], $productId, $request);

        return $newProduct;
    }

    private static function createProductType($productType, $productId, $request)
    {
        switch ($productType)
        {
            case 'book':
                self::createBook($request, $productId);
                break;
            case 'dvd':
                self::createDVD($request, $productId);
                break;
            case 'furniture':
                self::createFurniture($request, $productId);
                break;
        }
    }

    private static function createDVD($request, $productId)
    {
        DVD::create([
            'product_id' => $productId,
            'size' => $request['size']
        ]);
    }

    private static function createBook($request, $productId)
    {
        Book::create([
            'product_id' => $productId,
            'weight' => $request['weight']
        ]);
    }

    private static function createFurniture($request, $productId)
    {
        Furniture::create([
            'product_id' => $productId,
            'height' => $request['height'],
            'width' => $request['width'],
            'length' => $request['length']
        ]);
    }
}