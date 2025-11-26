<?php

namespace App\Http\Controllers;

use App\Models\Authorization;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AuthorizationController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if (! $user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        return response()->json($user->authorizations);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if (! $user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $data = $request->only(['provider', 'scopes']);

        $validator = Validator::make($data, [
            'provider' => 'required|string',
            'scopes' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $auth = Authorization::create(array_merge($validator->validated(), [
            'user_id' => $user->id,
            'token' => Str::random(40),
        ]));

        return response()->json($auth, 201);
    }

    public function show($id)
    {
        $auth = Authorization::find($id);

        if (! $auth) {
            return response()->json(['message' => 'Not found.'], 404);
        }

        return response()->json($auth);
    }
}
