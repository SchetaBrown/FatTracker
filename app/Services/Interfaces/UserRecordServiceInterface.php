<?php

namespace App\Services\Interfaces;

use App\Models\UserRecord;
use Illuminate\Support\Facades\Auth;

interface UserRecordServiceInterface
{
    public function getDataForIndexPage();
    public function destroyProductFromDiet(UserRecord $product);
    public function setUserRecord($request, $product);
}
