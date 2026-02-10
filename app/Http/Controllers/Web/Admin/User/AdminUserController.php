<?php

namespace App\Http\Controllers\Web\Admin\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepositoryInterface;

class AdminUserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        return view('pages.admin.user.index', [
            'users' => $this->userRepository->getAllUsers(request: $request, paginate: 10),
            'roles' => Role::get(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->userRepository->updateUserRole($user, $request->role_id);

        return redirect()->back();
    }
}
