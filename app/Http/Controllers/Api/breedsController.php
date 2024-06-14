<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Breeds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class breedsController extends Controller
{
    //

    public function index()
    {
        $breed = Breeds::all();
        if ($breed->count() > 0) {
            return response()->json([
                'status' => 200,
                'breeds' => $breed
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No breeds found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'cate_id' => 'integer|required|exists:categories,id', // Ensure cate_id exists in categories table
            'breed_name' => 'string|max:191|required', // Added required rule for breed_name
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create the Breed record
        $breed = Breeds::create([
            'cate_id' => $request->cate_id,
            'breed_name' => $request->breed_name
        ]);

        // Check if creation was successful
        if ($breed) {
            return response()->json([
                'status' => 200,
                'message' => 'Breed created successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $breed = Breeds::find($id);

        if (!$breed) {
            return response()->json([
                'status' => 404,
                'message' => 'Breed not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [

            'breed_name' => 'required|max:191',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $breed->update([

                'breed_name' => $request->breed_name,

            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Breed updated successfully'
            ], 200);
        }
    }

    public function delete($id)
    {
        $breed = Breeds::find($id);
        if ($breed) {
            $breed->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Breed deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Breed found'
            ], 404);
        }
    }
}
