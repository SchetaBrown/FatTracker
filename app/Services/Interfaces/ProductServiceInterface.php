<?php

namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface ProductServiceInterface
{
    public function getAllProducts(Request $request, $pagination = 10);
}
