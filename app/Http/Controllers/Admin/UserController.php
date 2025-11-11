<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
        $user = User::paginate('5');
        return view('admin.users.index', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        
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
