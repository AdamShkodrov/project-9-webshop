<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Models\Product; // If you want to relate roles to products, you can include this.
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
    
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $users = User::all(); // If you want to relate roles to products, you can include products here.
    
        return view('roles.create', compact('users'));
    }

    public function store(RoleRequest $request)
    {
        $role = new Role();
    
        $this->save($role, $request);
    
        return redirect('/roles');
    }

    public function show(Role $role)
    {
        $users = User::all(); // If needed, you can pass related products here.
    
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $users = User::all(); // If needed, you can pass related products here.

        return view('roles.edit', compact('role', 'users'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $this->save($role, $request);
    
        return redirect('/roles');
    }

    public function destroy(Role $role)
    {
        $role->delete();
    
        return redirect('/roles');
    }

    private function save(Role $role, Request $request)
    {
        $role->name = $request->name;
        $role->save();

        // If roles have a relationship with products (like attaching products), you can do it here.
        if ($request->has('product_id')) {
            $role->products()->attach($request->product_id);
        }
    }
}
