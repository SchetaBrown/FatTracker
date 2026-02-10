<?php

namespace App\Http\Controllers\Web\Admin\Product;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class AdminProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function index(Request $request)
    {
        return view('pages.admin.product.index', [
            'products' => $this->productRepository->getAllProducts($request),
        ]);
    }

    public function create()
    {
        return view('pages.admin.product.create', [
            'categories' => $this->productRepository->getProductCategories(),
        ]);
    }

    public function store(CreateProductRequest $request)
    {
        $this->productRepository->createProduct($request);

        return redirect()->route('admin.index');
    }

    public function edit(Product $product)
    {
        return view('pages.admin.product.edit', [
            'product' => $this->productRepository->getProductById($product->id),
            'categories' => $this->productRepository->getProductCategories(),
        ]);
    }

    public function update(Product $product, UpdateProductRequest $request)
    {
        $this->productRepository->updateProduct($request, $product);

        return redirect()->route('admin.product.index')->with('success', 'Данные о продукте обновлены');
    }

    public function destroy(Product $product)
    {
        $this->productRepository->deleteProduct($product);

        return redirect()->back()->with('success', 'Продукт удален');
    }
}
