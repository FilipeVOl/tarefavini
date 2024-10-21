<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->userService->getAllUsers();
    }

    public function me()
    {
        return $this->userService->getAuthenticatedUser();
    }

    public function store(UserCreateRequest $request)
    {
        return $this->userService->createUser($request);
    }

    public function show(string $id)
    {
        return $this->userService->getUserById($id);
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        return $this->userService->updateUser($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->userService->deleteUser($id);
    }
}