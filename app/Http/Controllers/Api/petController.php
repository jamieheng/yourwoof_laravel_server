<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class petController extends Controller
{
    public function index()
    {
        $pets = Pets::all();
        if ($pets->count() > 0) {
            return response()->json([
                'status' => 200,
                'pets' => $pets
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No pet found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pet_name' => 'required|max:191',
            'pet_gender_id' => 'required|integer',
            'pet_age' => 'required|integer',
            'pet_breed' => 'required|max:191',
            'pet_img' => 'required|max:255',
            'pet_description' => 'required',
            'pet_status' => 'required|max:191',
            'pet_cate_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $pet = Pets::create([
                'pet_name' => $request->pet_name,
                'pet_gender_id' => $request->pet_gender_id,
                'pet_age' => $request->pet_age,
                'pet_breed' => $request->pet_breed,
                'pet_img' => $request->pet_img,
                'pet_description' => $request->pet_description,
                'pet_status' => $request->pet_status,
                'pet_cate_id' => $request->pet_cate_id,
            ]);

            if ($pet) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Pet registered successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            }
        }
    }

    public function delete($id)
    {
        $pet = Pets::find($id);
        if ($pet) {
            $pet->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Pet deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Pet not found'
            ], 404);
        }
    }
    public function remove($id)
    {
        // Attempt to find the user by ID
        $pet = Pets::find($id);

        if (!$pet) {
            // If user with the specified ID is not found, return a 404 response
            return response()->json([
                'status' => 404,
                'message' => 'Pet not found'
            ], 404);
        }

        try {
            // Update the user's 'is_verified' field to 1
            $pet->is_removed = 1;
            $pet->save();

            // Return a success response with updated user details
            return response()->json([
                'status' => 200,
                'message' => 'Pet removed successfully',
                'pets' => $pet
            ], 200);
        } catch (\Exception $e) {
            // If an unexpected error occurs during the update process, return a 500 response
            return response()->json([
                'status' => 500,
                'message' => 'Failed to remove pet. Please try again later.'
            ], 500);
        }
    }
    public function getPets()
    {
        $pets = Pets::withTrashed()->get(); // This will include soft-deleted pets
        return response()->json(['pets' => $pets]);
    }


    public function update(Request $request, $id)
    {
        $pet = Pets::find($id);

        if (!$pet) {
            return response()->json([
                'status' => 404,
                'message' => 'Pet not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'pet_name' => 'required|max:191',
            'pet_gender_id' => 'required|integer',
            'pet_age' => 'required|integer',
            'pet_breed' => 'required|max:191',
            'pet_img' => 'required|max:255',
            'pet_description' => 'required',
            'pet_status' => 'required|max:191',
            'pet_cate_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $pet->update([
                'pet_name' => $request->pet_name,
                'pet_gender_id' => $request->pet_gender_id,
                'pet_age' => $request->pet_age,
                'pet_breed' => $request->pet_breed,
                'pet_img' => $request->pet_img,
                'pet_description' => $request->pet_description,
                'pet_status' => $request->pet_status,
                'pet_cate_id' => $request->pet_cate_id,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Pet updated successfully'
            ], 200);
        }
    }
}
