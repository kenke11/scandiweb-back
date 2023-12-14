<?php

namespace App\Controllers;


use App\Models\Book;
use App\Models\DVD;
use App\Models\Furniture;
use App\Models\Product;
use App\Providers\ProductProvider;
use App\Requests\ProductStoreRequest;

class ProductController
{
    public function index()
    {
        $products = Product::with(['book', 'dvd', 'furniture']);

        return response($products);
    }

    public function store()
    {
        $request = ProductStoreRequest::validation();

        if (array_key_exists('errors', $request))
        {
            return response($request, 422);
        }

        $product = ProductProvider::createProduct($request);

        return response(["message" => 'Products successfully created!', 'product' => $product->getData()]);
    }

    public function delete()
    {
        try {
            $ids = array_map('trim', explode(",", $_POST['ids']));
            foreach ($ids as $id)
            {
                Product::find($id)->delete();
                $books = Book::where('product_id', $id);
                $dvds = DVD::where('product_id', $id);
                $furnitures = Furniture::where('product_id', $id);

                foreach ($books as $book) {
                    $book->delete();
                }
                foreach ($dvds as $dvd) {
                    $dvd->delete();
                }
                foreach ($furnitures as $furniture) {
                    $furniture->delete();
                }
            }
        } catch (\Exception $exception) {
            return response($exception, 500);
        }

        return response(["message" => 'Products successfully deleted!']);
    }
}