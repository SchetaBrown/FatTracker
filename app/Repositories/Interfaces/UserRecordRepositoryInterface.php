<?php

namespace App\Repositories\Interfaces;

use App\Models\Product;
use App\Models\UserRecord;
use Illuminate\Http\Request;

interface UserRecordRepositoryInterface
{
    public function createUserRecord(Request $request, Product $product);
    public function deleteUserRecord(UserRecord $userRecord);
}
