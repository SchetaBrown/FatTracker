<?php

namespace App\Http\Controllers\Web\Profile;

use App\Models\ActivityLevel;
use App\Models\GoalType;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke()
    {
        return view('pages.profile.about', [
            'activity_levels' => $this->userRepository->getAllActivityLevels(),
            'goal_types' => $this->userRepository->getAllGoalTypes(),
        ]);
    }
}
