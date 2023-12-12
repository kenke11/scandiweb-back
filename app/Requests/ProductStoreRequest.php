<?php

namespace App\Requests;

use App\Models\Product;

class ProductStoreRequest extends Rule
{
    private static array $validationErrors = [];

    public static function validation(): array
    {
        $request = $_POST;

        $errors = self::getValidationErrors($request);

        if (!empty($errors))
        {
            return $errors;
        }

        return $request;
    }

    private static function getValidationErrors($request)
    {
        self::sku($request['sku']);
        self::name($request['name']);
        self::price($request['price']);
        self::productType($request['product_type']);

        switch ($request['product_type'])
        {
            case 'dvd':
                self::size($request['size']);
                break;
            case 'book':
                self::weight($request['weight']);
                break;
            case 'furniture':
                self::height($request['height']);
                self::width($request['width']);
                self::length($request['length']);
        }

        if (!empty(self::$validationErrors))
        {
            return self::$validationErrors;
        }

        return [];
    }

    private static function sku($sku)
    {
        $errorMessageUnique = Rule::unique('sku', $sku, Product::class);
        $errorMessageRequired = Rule::required($sku, 'sku');

        if ($errorMessageUnique) {
            self::$validationErrors['errors']['sku'] = $errorMessageUnique;
        }

        if ($errorMessageRequired) {
            self::$validationErrors['errors']['sku'] = $errorMessageRequired;
        }
    }

    private static function name($name)
    {
        $errorMessageRequired = Rule::required($name, 'name');


        if ($errorMessageRequired) {
            self::$validationErrors['errors']['name'] = $errorMessageRequired;
        }
    }

    private static function price($price)
    {
        $errorMessageRequired = Rule::required($price, 'price');
        $errorMessageNumeric = Rule::numeric($price, 'price');

        if ($errorMessageRequired) {
            self::$validationErrors['errors']['price'] = $errorMessageRequired;
        }

        if ($errorMessageNumeric) {
            self::$validationErrors['errors']['price'] = $errorMessageNumeric;
        }
    }

    private static function productType($productType)
    {
        $errorMessageRequired = Rule::required($productType, 'product_type');


        if ($errorMessageRequired) {
            self::$validationErrors['errors']['product_type'] = $errorMessageRequired;
        }
    }

    private static function size($size)
    {
        $errorMessageRequired = Rule::required($size, 'size');
        $errorMessageNumeric = Rule::numeric($size, 'size');

        if ($errorMessageRequired) {
            self::$validationErrors['errors']['size'] = $errorMessageRequired;
        }

        if ($errorMessageNumeric) {
            self::$validationErrors['errors']['size'] = $errorMessageNumeric;
        }
    }

    private static function weight($weight)
    {
        $errorMessageRequired = Rule::required($weight, 'weight');
        $errorMessageNumeric = Rule::numeric($weight, 'weight');

        if ($errorMessageRequired) {
            self::$validationErrors['errors']['weight'] = $errorMessageRequired;
        }

        if ($errorMessageNumeric) {
            self::$validationErrors['errors']['weight'] = $errorMessageNumeric;
        }
    }

    private static function height($height)
    {
        $errorMessageRequired = Rule::required($height, 'height');
        $errorMessageNumeric = Rule::numeric($height, 'height');

        if ($errorMessageRequired) {
            self::$validationErrors['errors']['height'] = $errorMessageRequired;
        }

        if ($errorMessageNumeric) {
            self::$validationErrors['errors']['height'] = $errorMessageNumeric;
        }
    }

    private static function width($width)
    {
        $errorMessageRequired = Rule::required($width, 'width');
        $errorMessageNumeric = Rule::numeric($width, 'width');

        if ($errorMessageRequired) {
            self::$validationErrors['errors']['width'] = $errorMessageRequired;
        }

        if ($errorMessageNumeric) {
            self::$validationErrors['errors']['width'] = $errorMessageNumeric;
        }
    }

    private static function length($length)
    {
        $errorMessageRequired = Rule::required($length, 'length');
        $errorMessageNumeric = Rule::numeric($length, 'length');

        if ($errorMessageRequired) {
            self::$validationErrors['errors']['length'] = $errorMessageRequired;
        }

        if ($errorMessageNumeric) {
            self::$validationErrors['errors']['length'] = $errorMessageNumeric;
        }
    }
}