<?php

namespace App\Repositories;

use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductUnit;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Requests\Product\CreateProductRequest;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    private Product $product;
    private ProductCategory $productCategory;
    private ProductUnit $productUnit;

    public function __construct(Product $product, ProductCategory $productCategory, ProductUnit $productUnit)
    {
        $this->product = $product;
        $this->productCategory = $productCategory;
        $this->productUnit = $productUnit;
    }

    // Получение всех продуктов
    public function getAllProducts(Request $request, $pagination = 10)
    {
        $products = $this->product->query();

        if ($request->has('category')) {
            if ($request->category !== '#') {
                $products->where('product_category_id', $request->category);
            }
        }

        if ($request->has("title")) {
            $products->where('title', 'LIKE', "%{$request->title}%");
        }

        return $products->paginate($pagination)->withQueryString();
    }

    // Создание нового продукта
    public function createProduct(CreateProductRequest $request)
    {
        try {
            $this->product->create($request->validated());
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    // Обновление новго продукта
    public function updateProduct(UpdateProductRequest $request, Product $product)
    {
        try {
            $product->update($request->validated());
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    // Удаление продукта
    public function deleteProduct(Product $product)
    {
        $product->delete();
    }

    // Получение продукта по $id
    public function getProductById($id)
    {
        return $this->product->find($id);
    }

    // Получение всех категорий продуктов
    public function getProductCategories()
    {
        return $this->productCategory->get();
    }

    // Получение всех unit продуктов
    public function getProductUnits()
    {
        return $this->productUnit->get();
    }
}
