<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;


interface UserRepositoryInterface
{
    public function getAllUsers(Request $request, $paginate = 10);
    public function createUser(RegisterRequest $request);
    public function updateUserRole(User $user, $roleId);
    public function getUserById($id);
    public function getAllGoalTypes();
    public function getAllRoles();
    public function getAllActivityLevels();
    public function getAllGenders();
}
