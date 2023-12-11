<?php

namespace App\Controllers;


use App\Models\Product;
use App\Providers\ProductProvider;

class ProductController
{
    public function index()
    {
        $products = Product::all();

        return response($products);
    }

    public function store()
    {
        try {
            $product = ProductProvider::createProduct($_POST);
        } catch (\Exception $exception) {
            return response($exception, 500);
        }

        return response(["message" => 'Products successfully created!', 'product' => $product->getData()]);
    }

    public function delete()
    {
        try {
            $ids = array_map('trim', explode(",", $_POST['ids']));
            foreach ($ids as $id)
            {
                Product::find($id)->delete();
            }
        } catch (\Exception $exception) {
            return response($exception, 500);
        }

        return response(["message" => 'Products successfully deleted!']);
    }
}