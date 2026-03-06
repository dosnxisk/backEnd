<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::post('/login', function (Request $request) {
    
    $user = User::where('email', $request->email)->first();

    
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});