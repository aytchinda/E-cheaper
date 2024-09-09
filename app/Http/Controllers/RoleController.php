<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RoleFormRequest;
use Illuminate\Support\Facades\Storage;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::orderBy('created_at', 'desc')->paginate(5);
        return view('roles/index', ['roles' => $roles]);
    }

    public function show($id): View
    {
        $role = Role::findOrFail($id);

        return view('roles/show',['role' => $role]);
    }
    public function create(): View
    {
        return view('roles/create');
    }

    public function edit($id): View
    {
        $role = Role::findOrFail($id);
        return view('roles/edit', ['role' => $role]);
    }

    public function store(RoleFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

        

        $role = Role::create($data);
        return redirect()->route('admin.role.show', ['id' => $role->id]);
    }

    public function update(Role $role, RoleFormRequest $req)
    {
        $data = $req->validated();

        

        $role->update($data);

        return redirect()->route('admin.role.show', ['id' => $role->id]);
    }

    public function updateSpeed(Role $role, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $role->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Role $role)
    {
        
        $role->delete();

        return [
            'isSuccess' => true
        ];
    }

    
}