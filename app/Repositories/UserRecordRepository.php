<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRecordRepositoryInterface;
use Exception;
use App\Models\Meal;
use App\Models\UserRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRecordRepository implements UserRecordRepositoryInterface
{
    public function createUserRecord(Request $request, $product)
    {
        try {
            if ($request->has('meal_id') || $request->has('meal')) {
                UserRecord::create([
                    'quantity' => $request->quantity,
                    'user_id' => Auth::id(),
                    'date' => session()->get('day'),
                    'meal_id' => Meal::where('title', $request->meal_id)->orWhere('id', $request->meal_id)->first()->id,
                    'product_id' => $product->id,
                    'product_unit_id' => $request->product_unit_id,
                ]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteUserRecord(UserRecord $userRecord)
    {
        $userRecord->delete();
    }
}
