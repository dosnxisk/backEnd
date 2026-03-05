<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/token-test', function () {
    $user = \App\Models\User::first();
    if (!$user) {
        return response()->json(['message' => 'No user found']);
    }
    $token = $user->createToken('test-token')->plainTextToken;
    return $token;
});