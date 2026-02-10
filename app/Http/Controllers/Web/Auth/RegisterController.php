<?php

namespace App\Http\Controllers\Web\Auth;

use App\Models\User;
use App\Models\Gender;
use App\Models\GoalType;
use App\Models\ActivityLevel;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserRecordServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    private UserServiceInterface $userService;
    private UserRepositoryInterface $userRepository;
    public function __construct(UserServiceInterface $userService, UserRepositoryInterface $userRepository)
    {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    public function create()
    {
        return view('pages.auth.register', [
            'activityLevels' => $this->userRepository->getAllActivityLevels(),
            'genders' => $this->userRepository->getAllGenders(),
            'goals' => $this->userRepository->getAllGoalTypes(),
        ]);
    }

    public function store(RegisterRequest $request)
    {
        try {
            $user = $this->userRepository->createUser($request);
            Auth::login($user);
            $this->userService->setUserNormalCalories($user);
            return redirect()->route('index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
