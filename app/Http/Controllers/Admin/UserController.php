<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index()
    {
        $admin = Admin::with('roles')->find(Auth::guard('admin')->id());
       $isSuperAdmin = $admin->roles->contains('name', 'master_admin');

        if ($isSuperAdmin) {
            // super admin gets all users
            $user = User::latest()->paginate(5);
        } else {
            // normal admin gets only their users
            $user = User::where('admin_id', $admin->id)
                        ->latest()
                        ->paginate(5);
        }
        return view('admin.users.index', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        
         $request->validate([
        'name' => 'required',
        'mobile' => 'required|numeric|digits:10|unique:users,mobile',
        'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'password_spy' => $request->password,
            'admin_id' => Auth::guard('admin')->user()->id, // link to logged-in admin
            'mobile' => $request->mobile,
        ]);

        return redirect()->back()->with('success', 'User created successfully.');
    }

    public function show($id)
    {
    
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
    
    }

    public function destroy($id)
    {
        
    }
    public function getRandomUsername()
    {
        $username = $this->generateRandomUsername();
        return response()->json(['username' => $username]);
    }

    private function generateRandomUsername()
    {
        // Logic to generate a random username
        $username = 'user_' . uniqid();
        return $username;
    }
}
