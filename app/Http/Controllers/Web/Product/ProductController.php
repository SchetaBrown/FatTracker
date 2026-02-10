<?php

namespace App\Http\Controllers\Web\Product;

use App\Models\Product;
use App\Models\UserRecord;
use App\Repositories\Interfaces\MealRepositoryInterface;
use App\Repositories\Interfaces\UserRecordRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;
    private MealRepositoryInterface $mealRepository;
    private UserRecordRepositoryInterface $userRecordRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        MealRepositoryInterface $mealRepository,
        UserRecordRepositoryInterface $userRecordRepository
    ) {
        $this->productRepository = $productRepository;
        $this->mealRepository = $mealRepository;
        $this->userRecordRepository = $userRecordRepository;
    }
    public function index(Request $request)
    {
        return view('pages.product.index', [
            'products' => $this->productRepository->getAllProducts($request, 15)->withQueryString(),
            'categories' => $this->productRepository->getProductCategories(),
            'units' => $this->productRepository->getProductUnits(),
            'meals' => $this->mealRepository->getMeals(),
        ]);
    }

    public function store(Request $request, Product $product)
    {
        $this->userRecordRepository->createUserRecord($request, $product);

        return redirect()->route('index', [
            'day' => session()->get('day')
        ]);
    }

    public function destroy(UserRecord $record)
    {
        $this->userRecordRepository->deleteUserRecord($record);
        return redirect()->back()->with("success", "Продукт удален из рациона");
    }
}
