<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
    
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all(); // If you want to relate users to products, you can include products here.
    
        return view('users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $user = new User();
    
        $this->save($user, $request);
    
        return redirect('/users');
    }

    public function show($user)
    {
        $user = User::find($user);
        $roles = Role::all(); // If needed, you can pass related products here.
    
        return view('users.show', compact('user'));
    }

    public function edit(User $users)
    {
        $user = User::findorfail($users->id);
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, User $user)
    {
        $this->save($user, $request);
    
        return redirect('/users');
    }

    public function destroy(User $user)
    {
        $user->delete();
    
        return redirect('/users');
    }

    private function save(User $user, Request $request)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Hash the password before saving it.
        $user->save();

        // If users have a relationship with products (like attaching products), you can do it here.
        if ($request->has('product_id')) {
            $user->products()->attach($request->product_id);
        }
    }
}
