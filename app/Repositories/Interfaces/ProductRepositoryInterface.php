<?php

namespace App\Repositories\Interfaces;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

interface ProductRepositoryInterface
{
    public function getProductCategories();
    public function getAllProducts(Request $request, $pagination = 10);
    public function getProductUnits();
    public function getProductById($id);
    public function updateProduct(UpdateProductRequest $request, Product $product);
    public function deleteProduct(Product $product);
    public function createProduct(CreateProductRequest $request);
}
