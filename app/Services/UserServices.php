<?php

namespace App\Services;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getAllUsers()
    {
        $users = User::select('id', 'name', 'email', 'created_at')->paginate(10);

        return [
            'status' => 200,
            'message' => 'Usuários encontrados!',
            'users' => $users
        ];
    }

    public function getAuthenticatedUser()
    {
        $user = Auth::user();

        return [
            'status' => 200,
            'message' => 'Usuário logado!',
            'user' => $user
        ];
    }

    public function createUser(UserCreateRequest $request)
    {
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return [
            'status' => 200,
            'message' => 'Usuário cadastrado com sucesso!',
            'user' => $user
        ];
    }

    public function getUserById(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return [
                'status' => 404,
                'message' => 'Usuário não encontrado!',
                'user' => null
            ];
        }

        return [
            'status' => 200,
            'message' => 'Usuário encontrado com sucesso!',
            'user' => $user
        ];
    }

    public function updateUser(UserUpdateRequest $request, string $id)
    {
        $data = $request->all();

        $user = User::find($id);

        if (!$user) {
            return [
                'status' => 404,
                'message' => 'Usuário não encontrado!',
                'user' => null
            ];
        }

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return [
            'status' => 200,
            'message' => 'Usuário atualizado com sucesso!',
            'user' => $user
        ];
    }

    public function deleteUser(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return [
                'status' => 404,
                'message' => 'Usuário não encontrado!',
                'user' => null
            ];
        }

        $user->delete();

        return [
            'status' => 200,
            'message' => 'Usuário deletado com sucesso!'
        ];
    }
}