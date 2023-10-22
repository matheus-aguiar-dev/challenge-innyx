<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
	/**
	 * Register a new user.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\JsonResponse
	 */

	public function me(Request $request)
	{
		return $request->user();
	}
	public function login(Request $request)
	{
		$credentials = $request->only('email', 'password');

		if (Auth::attempt($credentials)) {
			$user = User::where('email', $request->email)->first();
			$token = $user->createToken('AuthToken')->plainTextToken;

			return response()->json(['token' => $token], 200);
		}

		return response()->json(['error' => 'Unauthorized'], 401);
	}

	/**
	 * Log out the user (revoke the token).
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout(Request $request)
	{
		$request->user()->tokens()->delete();

		return response()->json(['message' => 'Logged out successfully'], 200);
	}
}

