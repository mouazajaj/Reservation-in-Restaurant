<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function Register(Request $request)
    {
        try {
       
            $validateUser =Validator::make($request->all(), 
            [   'Name' => 'required',
                'email' => 'required|unique:users',
                'password' =>'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
                ], 401);
            }
            
            $user = User::create([
                'Name' => $request->Name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken('apiToken')->plainTextToken,
            ], 200);

        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th-getMessage()
            ], 500);
        }
    }
  
    

    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
          
        ]);
     
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return $user->createToken('tokens')->plainTextToken;
       
      }
        
        public function Logout(Request $request)
        {   auth()->user()->tokens()->delete();
            return [
                'message' => 'user logged out'
            ];
        }
}
