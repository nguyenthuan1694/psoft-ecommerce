<?php

use Illuminate\Support\Str;

if (! function_exists('generateProductImageName')) {
    /**
     * Generate product image name
     *
     * @param string $sku
     * @param string $extension
     * @param string $type
     * @return string
     */
    function generateProductImageName($sku, $extension, $type = 'thumbnail') {
        $randomString = md5(time() . Str::random(10));
        switch (strtolower($type)) {
            case 'image':
                return 'image_' . $sku . '_' . $randomString . '.' . $extension;
            default:
                return 'thumbnail_' . $sku . '_' . $randomString . '.' . $extension;
        }
    }
}

if (! function_exists('generateProductImagePath')) {
    /**
     * Generate product image name
     *
     * @param string $sku
     * @param string $type
     * @return string
     */
    function generateProductImagePath($sku, $type = 'thumbnail') {
        switch (strtolower($type)) {
            case 'image':
                return 'images/product/' . $sku . '/image';
            default:
                return 'images/product/' . $sku . '/thumbnail';
        }
    }
}