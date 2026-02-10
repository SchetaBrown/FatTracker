<?php

namespace App\Services\Interfaces;

use App\Models\UserRecord;
use Illuminate\Http\Request;

interface UserRecordServiceInterface
{
    public function getDataForIndexPage(Request $request);
}
