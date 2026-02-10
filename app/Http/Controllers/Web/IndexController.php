<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\UserRecordServiceInterface;

class IndexController extends Controller
{
    private UserRecordServiceInterface $userRecordService;

    public function __construct(UserRecordServiceInterface $userRecordService)
    {
        $this->userRecordService = $userRecordService;
    }

    public function index(Request $request)
    {
        return view('pages.index', [
            'userRecords' => $this->userRecordService->getDataForIndexPage($request),
        ]);
    }
}
