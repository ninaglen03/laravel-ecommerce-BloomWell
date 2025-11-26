<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user) {
            return response()->json($user->registration);
        }

        return response()->json(['message' => 'Unauthenticated.'], 401);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if (! $user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $data = $request->only(['status', 'registered_at', 'data']);

        $validator = Validator::make($data, [
            'status' => 'required|string',
            'registered_at' => 'nullable|date',
            'data' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $registration = Registration::updateOrCreate(
            ['user_id' => $user->id],
            array_merge($validator->validated(), ['user_id' => $user->id])
        );

        return response()->json($registration, 201);
    }

    public function show($id)
    {
        $registration = Registration::find($id);

        if (! $registration) {
            return response()->json(['message' => 'Not found.'], 404);
        }

        return response()->json($registration);
    }
}
