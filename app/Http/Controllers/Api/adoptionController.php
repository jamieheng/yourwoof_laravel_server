<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adoption;
use Illuminate\Support\Facades\Validator;

class adoptionController extends Controller
{
    //
    public function index()
    {
        $adoption = Adoption::all();
        if ($adoption->count() > 0) {
            return response()->json([
                'status' => 200,
                'adoptions' => $adoption
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No adoption found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $adoption = Adoption::create([
            'user_id' => $request->user_id,
            'pet_id' => $request->pet_id,
        ]);

        if ($adoption) {
            return response()->json([
                'status' => 200,
                'message' => 'Pet registered successfully',
                'adoptions' => $adoption
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function approveAdoption($id)
    {
        // Attempt to find the adoption by ID
        $adoption = Adoption::find($id);

        if (!$adoption) {
            // If adoption with the specified ID is not found, return a 404 response
            return response()->json([
                'status' => 404,
                'message' => 'Adoption not found'
            ], 404);
        }

        try {
            // Update the adoption's 'is_approved' field to true
            $adoption->is_approved = true;
            $adoption->save();

            // Return a success response with updated adoption details
            return response()->json([
                'status' => 200,
                'message' => 'Adoption approved successfully',
                'adoption' => $adoption // Changed 'adoptions' to 'adoption'
            ], 200);
        } catch (\Exception $e) {
            // If an unexpected error occurs during the update process, return a 500 response
            return response()->json([
                'status' => 500,
                'message' => 'Failed to approve adoption. Please try again later.'
            ], 500);
        }
    }





    public function destroy($id)
    {
        $adoption = Adoption::find($id);
        if ($adoption) {
            $adoption->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Adoption deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Adoption not found'
            ], 404);
        }
    }
}
