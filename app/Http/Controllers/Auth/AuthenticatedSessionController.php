<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): Response{

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        // dd($request);
        // $user = User::find($request->email);
        // $authToken = $user->createToken("auth-token")->plainTextToken;
        // return response($authToken);

        // $user = Auth::user();
        // $authToken = $user->createToken($user->name())->plainTextToken;
        // $authToken = $user->createToken("auth-token")->plainTextToken;


        // return response()->json([
        //     "success" => true,
        //     "data" => [
        //         "token" => $authToken,
        //         "name" => $user->name(),
        //     ],
        //     "message" => "user logged in !"
        // ]);

        return response()->noContent();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
