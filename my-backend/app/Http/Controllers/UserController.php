<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
        {
            return response()->json(User::all());
        }
        
        public function show($id)
        {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
            return response()->json($user);
        }
    
        public function addusers(Request $request)
        {
           
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            return response()->json(['message' => 'User updated successfully', 'user' => $user]);
        }

        public function update(Request $request, $id)
        {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
            
    
            $user->update($request->only(['name', 'email']));
            return response()->json($user);
        }

        public function delete($id)
        {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
    
            $user->delete();
            return response()->json(['message' => 'User deleted']);
        }
}
