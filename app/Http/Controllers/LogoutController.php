<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function destroy()
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $user->tokens()->delete();

        return response()->json(['message' => 'Success Logout']);
    }
}
