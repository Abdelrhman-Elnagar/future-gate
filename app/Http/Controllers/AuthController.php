<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('logout');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'seat_number' => 'required',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials)) {
                $user = User::with(['governate', 'educationalAdministration', 'school', 'specialization'])
                    ->find(Auth::id());

                if (!$user) {
                    return response()->json(['message' => 'User data not found.'], 404);
                }

                $token = $user->createToken('future-gate')->plainTextToken;
                return response()->json(['token' => $token, 'user' => $user], 200);
            }

            return response()->json(['message' => 'Invalid credentials'], 401);
        } catch (\Exception $e) {
            Log::error("Error in login: " . $e->getMessage());
            return response()->json(['message' => 'Login failed.', 'error' => $e->getMessage()], 500);
        }
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }


    public function register(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name'                          => 'required|string|max:255',
            'email'                         => 'required|email|unique:users,email',
            'password'                      => 'required|string|min:6|confirmed',
            'seat_number'                   => 'required|integer|unique:students,seat_number',
            'grade'                         => 'required|numeric|between:0,100',
            'governorate_id'                => 'required|exists:governorates,id',
            'educational_administration_id' => 'required|exists:educational_administrations,id',
            'school_id'                     => 'required|exists:schools,id',
            'specialization_id'             => 'required|exists:specializations,id',
            'phone_number'                  => 'nullable|string|max:20',
            'national_id'                   => 'nullable|string|max:14',
            'gender'                        => 'required|in:ذكر,أنثى',
            'date_of_birth'                 => 'nullable|date',
            'address'                        => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create the user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'student',
        ]);

        // Create the student and link to the user
        $student = Student::create([
            'seat_number'                   => $request->seat_number,
            'user_id'                        => $user->id,
            'grade'                          => $request->grade,
            'governorate_id'                 => $request->governorate_id,
            'educational_administration_id'  => $request->educational_administration_id,
            'school_id'                      => $request->school_id,
            'specialization_id'              => $request->specialization_id,
            'phone_number'                   => $request->phone_number,
            'national_id'                    => $request->national_id,
            'gender'                         => $request->gender,
            'date_of_birth'                  => $request->date_of_birth,
            'address'                         => $request->address,
        ]);

        // Generate API token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully!',
            'token'   => $token,
            'user'    => $user,
            'student' => $student,
        ], 201);
    }
}
