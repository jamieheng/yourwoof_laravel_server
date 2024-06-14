<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class userController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        if ($users->count() > 0) {
            return response()->json([
                'status' => 200,
                'users' => $users
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No user found'
            ], 404);
        }
    }

    public function getUserById($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json([
                'status' => 200,
                'users' => $user
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ], 404);
        }
    }

    // public function phone_auth

    public function register(Request $request)
    {
        // Validate input based on email or phone presence
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required_without:phone|email|unique:users,email|max:191',
            'phone' => 'required_without:email|nullable|regex:/^\+855[0-9]{8,9}$/|unique:users,phone',
            'address' => 'nullable|max:191',
            'password' => [
                'required',
                'string',
                'min:10',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'password' => Hash::make($request->password),
            ]);

            if ($user) {
                return response()->json([
                    'status' => 200,
                    'message' => 'User created successfully',
                    'users' => $user
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            }
        }
    }


    public function login(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'identity' => 'required',
            'password' => 'required|string',
        ]);

        // If validation fails, return errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => 422,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Attempt to find the user by phone or email
        $user = User::where(function ($query) use ($request) {
            $query->where('phone', $request->identity)
                ->orWhere('email', $request->identity);
        })->first();

        // If user not found, return error response
        if (!$user) {
            return response()->json([
                'success' => false,
                'status' => 401,
                'message' => 'User not found!',
            ], 401);
        }

        // If password does not match, return error response
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'status' => 401,
                'message' => 'Wrong Password!',
            ], 401);
        }

        // Generate a token for the user
        $token = Str::random(60);

        // Update the user's token
        $user->update(['api_token' => $token]);

        // Unset password from the user object
        unset($user->password);

        // Check user's role and return response accordingly
        if ($user->role_id === 1) {
            // If user role is 1, it's an admin
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Admin authenticated successfully',
                'users' => $user,
                'token' => $token,
            ], 200);
        } elseif ($user->role_id === 2) {
            // If user role is 2, it's a regular user
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'User authenticated successfully',
                'user' => $user,
                'token' => $token,
            ], 200);
        } else {
            // Handle other roles if needed
            return response()->json([
                'success' => false,
                'status' => 403,
                'message' => 'Unauthorized role!',
            ], 403);
        }
    }



    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'phone' => 'regex:/^\+855[0-9]{8,9}$/',
            'address' => 'required|max:191',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    'status' => 404,
                    'message' => 'User not found'
                ], 404);
            }

            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'address' => $request->address,


            ]);

            return response()->json([
                'status' => 200,
                'message' => 'User updated successfully',
                'users' => $user
            ], 200);
        }
    }



    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json([
                'status' => 200,
                'message' => 'User deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ], 404);
        }
    }

    public function verified($id)
    {
        // Attempt to find the user by ID
        $user = User::find($id);

        if (!$user) {
            // If user with the specified ID is not found, return a 404 response
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ], 404);
        }

        try {
            // Update the user's 'is_verified' field to 1
            $user->is_verified = 1;
            $user->save();

            // Return a success response with updated user details
            return response()->json([
                'status' => 200,
                'message' => 'User verified successfully',
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            // If an unexpected error occurs during the update process, return a 500 response
            return response()->json([
                'status' => 500,
                'message' => 'Failed to verify user. Please try again later.'
            ], 500);
        }
    }

    public function as_admin($id)
    {
        // Attempt to find the user by ID
        $user = User::find($id);

        if (!$user) {
            // If user with the specified ID is not found, return a 404 response
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ], 404);
        }

        try {
            // Update the user's 'is_verified' field to 1
            $user->role_id = 1;
            $user->save();

            // Return a success response with updated user details
            return response()->json([
                'status' => 200,
                'message' => 'User verified successfully',
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            // If an unexpected error occurs during the update process, return a 500 response
            return response()->json([
                'status' => 500,
                'message' => 'Failed to verify user. Please try again later.'
            ], 500);
        }
    }
}
