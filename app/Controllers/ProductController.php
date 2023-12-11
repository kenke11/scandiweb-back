<?php

namespace App\Controllers;


use App\Models\Product;

class ProductController
{
    public function index()
    {
        $products = Product::all();

        return response($products);
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