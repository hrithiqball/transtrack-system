<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Http\Requests\ReadUserRequest;

class UserController extends Controller
{
    public function list(ReadUserRequest $request): JsonResponse
    {
        $users = User::all();

        if ($request->has('role')) {
            $users = User::where('role', $request->role)->get();
        }

        return response()->json($users);
    }
}
