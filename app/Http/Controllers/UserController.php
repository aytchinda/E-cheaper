<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::orderBy('created_at', 'desc')->paginate(5);
        return view('users/index', ['users' => $users]);
    }

    public function show($id): View
    {
        $user = User::findOrFail($id);

        return view('users/show',['user' => $user]);
    }
    public function create(): View
    {
        $roles = Role::all();
        return view('users/create',['roles'=>$roles]);
    }

    public function edit($id): View
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users/edit', ['user' => $user,'roles'=>$roles]);
    }

    public function store(UserFormRequest $req): RedirectResponse
    {
        $roles = $req->validated('roles');
        $data = $req->validated();

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        $user->roles()->sync($roles);
        return redirect()->route('admin.user.show', ['id' => $user->id]);
    }

    public function update(User $user, UserFormRequest $req)
    {
        $roles = $req->validated('roles');
        $data = $req->validated();


        $data['password'] = Hash::make($data['password']);
        $user->update($data);

        $user->roles()->sync($roles);

        return redirect()->route('admin.user.show', ['id' => $user->id]);
    }

    public function updateSpeed(User $user, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $user->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(User $user)
    {

        $user->delete();

        return [
            'isSuccess' => true
        ];
    }


}
