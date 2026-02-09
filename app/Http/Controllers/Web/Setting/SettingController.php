<?php

namespace App\Http\Controllers\Web\Setting;

use App\Http\Controllers\Controller;
use App\Models\ActivityLevel;
use App\Models\GoalType;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('pages.profile.settings', [
            'user' => auth()->user(),
            'goals' => GoalType::get(),
            'activityLevels' => ActivityLevel::get(),
        ]);
    }

    public function update(Request $request)
    {
        if ($request->has('activity_level_id')) {
            auth()->user()->update([
                'activity_level_id' => $request->activity_level_id,
            ]);
        }

        if ($request->has('goal_type_id')) {
            // dd($request);
            auth()->user()->update([
                'goal_type_id' => $request->goal_type_id,
            ]);
        }

        return redirect()->back();
    }
}
