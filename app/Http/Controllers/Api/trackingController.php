<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\Tracking;
use Illuminate\Http\Request;

class trackingController extends Controller
{
    public function index()
    {
        $trackings = Tracking::all();
        if ($trackings->count() > 0) {
            return response()->json([
                'status' => 200,
                'trackings' => $trackings
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No tracking found'
            ], 404);
        }
    }

    public function getTrackingById($id)
    {
        $tracking = Tracking::find($id);
        if ($tracking) {
            return response()->json([
                'status' => 200,
                'trackings' => $tracking
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tracking not found'
            ], 404);
        }
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'pet_id' => 'required|integer',


        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $tracking = Tracking::create([
                'user_id' => $request->user_id,
                'pet_id' => $request->pet_id,


            ]);

            if ($tracking) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Pet registered successfully',
                    'trackings' => $tracking
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            }
        }
    }


    public function destroy($id)
    {
        $tracking = Tracking::find($id);
        if ($tracking) {
            $tracking->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Tracking deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tracking not found'
            ], 404);
        }
    }

    public function updatePetWeek1(Request $request, $id)
    {
        // Validate the request to ensure pet_img_week1 is a valid URL
        $validator = Validator::make($request->all(), [
            'pet_img_week1' => 'string|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Attempt to find the tracking record by ID
        $tracking = Tracking::find($id);

        if (!$tracking) {
            return response()->json([
                'status' => 404,
                'message' => 'Tracking record not found'
            ], 404);
        }

        try {
            // Update the tracking record with the new image URL
            $tracking->update([
                'pet_img_week1' => $request->pet_img_week1,
            ]);

            // Return a success response with the updated tracking details
            return response()->json([
                'status' => 200,
                'message' => 'Image URL for week 1 updated successfully',
                'trackings' => $tracking
            ], 200);
        } catch (\Exception $e) {
            // If an unexpected error occurs during the update process, return a 500 response
            return response()->json([
                'status' => 500,
                'message' => 'Failed to update image URL. Please try again later.'
            ], 500);
        }
    }

    public function updatePetWeek2(Request $request, $id)
    {
        // Validate the request to ensure pet_img_week1 is a valid URL
        $validator = Validator::make($request->all(), [
            'pet_img_week2' => 'string|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Attempt to find the tracking record by ID
        $tracking = Tracking::find($id);

        if (!$tracking) {
            return response()->json([
                'status' => 404,
                'message' => 'Tracking record not found'
            ], 404);
        }

        try {
            // Update the tracking record with the new image URL
            $tracking->update([
                'pet_img_week2' => $request->pet_img_week2,
            ]);

            // Return a success response with the updated tracking details
            return response()->json([
                'status' => 200,
                'message' => 'Image URL for week 1 updated successfully',
                'trackings' => $tracking
            ], 200);
        } catch (\Exception $e) {
            // If an unexpected error occurs during the update process, return a 500 response
            return response()->json([
                'status' => 500,
                'message' => 'Failed to update image URL. Please try again later.'
            ], 500);
        }
    }

    public function updatePetWeek3(Request $request, $id)
    {
        // Validate the request to ensure pet_img_week1 is a valid URL
        $validator = Validator::make($request->all(), [
            'pet_img_week3' => 'string|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Attempt to find the tracking record by ID
        $tracking = Tracking::find($id);

        if (!$tracking) {
            return response()->json([
                'status' => 404,
                'message' => 'Tracking record not found'
            ], 404);
        }

        try {
            // Update the tracking record with the new image URL
            $tracking->update([
                'pet_img_week3' => $request->pet_img_week3,
            ]);

            // Return a success response with the updated tracking details
            return response()->json([
                'status' => 200,
                'message' => 'Image URL for week 1 updated successfully',
                'trackings' => $tracking
            ], 200);
        } catch (\Exception $e) {
            // If an unexpected error occurs during the update process, return a 500 response
            return response()->json([
                'status' => 500,
                'message' => 'Failed to update image URL. Please try again later.'
            ], 500);
        }
    }

    public function updatePetWeek4(Request $request, $id)
    {
        // Validate the request to ensure pet_img_week1 is a valid URL
        $validator = Validator::make($request->all(), [
            'pet_img_week4' => 'string|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Attempt to find the tracking record by ID
        $tracking = Tracking::find($id);

        if (!$tracking) {
            return response()->json([
                'status' => 404,
                'message' => 'Tracking record not found'
            ], 404);
        }

        try {
            // Update the tracking record with the new image URL
            $tracking->update([
                'pet_img_week4' => $request->pet_img_week4,
            ]);

            // Return a success response with the updated tracking details
            return response()->json([
                'status' => 200,
                'message' => 'Image URL for week 1 updated successfully',
                'trackings' => $tracking
            ], 200);
        } catch (\Exception $e) {
            // If an unexpected error occurs during the update process, return a 500 response
            return response()->json([
                'status' => 500,
                'message' => 'Failed to update image URL. Please try again later.'
            ], 500);
        }
    }

    public function completed($id)
    {
        // Attempt to find the user by ID
        $tracking = Tracking::find($id);

        if (!$tracking) {
            // If user with the specified ID is not found, return a 404 response
            return response()->json([
                'status' => 404,
                'message' => 'Tracking not found'
            ], 404);
        }

        try {
            // Update the user's 'is_verified' field to 1
            $tracking->is_completed = 1;
            $tracking->save();

            // Return a success response with updated user details
            return response()->json([
                'status' => 200,
                'message' => 'Tracking completed successfully',
                'trackings' => $tracking
            ], 200);
        } catch (\Exception $e) {
            // If an unexpected error occurs during the update process, return a 500 response
            return response()->json([
                'status' => 500,
                'message' => 'Failed to verify user. Please try again later.'
            ], 500);
        }
    }

    public function reported($id)
    {
        // Attempt to find the user by ID
        $tracking = Tracking::find($id);

        if (!$tracking) {
            // If user with the specified ID is not found, return a 404 response
            return response()->json([
                'status' => 404,
                'message' => 'Tracking not found'
            ], 404);
        }

        try {
            // Update the user's 'is_verified' field to 1
            $tracking->is_bad_user = 1;
            $tracking->save();

            // Return a success response with updated user details
            return response()->json([
                'status' => 200,
                'message' => 'Tracking reported successfully',
                'trackings' => $tracking
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
