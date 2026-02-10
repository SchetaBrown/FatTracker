<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Models\Gender;
use App\Models\GoalType;
use Illuminate\Http\Request;
use App\Models\ActivityLevel;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers(Request $request, $paginate = 10)
    {
        $users = User::with(['role', 'activityLevel', 'goalType', 'gender'])->orderBy('role_id', 'desc');

        if ($request->has("login")) {
            $users->where('login', 'LIKE', "%{$request->login}%");
        }

        return $users->paginate($paginate);
    }

    public function createUser(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        return $user;
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function updateUserRole(User $user, $roleId)
    {
        if (!($user->login === Auth::user()->login)) {
            $user->update([
                'role_id' => $roleId
            ]);
        }

        return redirect()->back()->with('error', 'Недостаточно прав для изменения роли');
    }

    public function getAllActivityLevels()
    {
        return ActivityLevel::orderBy('multiplier', 'asc')->get();
    }

    public function getAllGoalTypes()
    {
        return GoalType::orderBy('calorie_modifier', 'asc')->get();
    }

    public function getAllRoles()
    {
        return Role::get();
    }

    public function getAllGenders()
    {
        return Gender::get();
    }
}
