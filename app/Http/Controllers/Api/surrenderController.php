<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;

use App\Models\Surrender;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class surrenderController extends Controller
{
    public function index()
    {
        $surrenders = Surrender::all();
        if ($surrenders->count() > 0) {
            return response()->json([
                'status' => 200,
                'surrenders' => $surrenders
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No surrender found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
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
            $surrenders = Surrender::create([
                'user_id' => $request->user_id,
                'pet_name' => $request->pet_name,
                'pet_gender_id' => $request->pet_gender_id,
                'pet_age' => $request->pet_age,
                'pet_breed' => $request->pet_breed,
                'pet_img' => $request->pet_img,
                'pet_description' => $request->pet_description,
                'pet_status' => $request->pet_status,
                'pet_cate_id' => $request->pet_cate_id,
            ]);

            if ($surrenders) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Pet registered successfully',
                    'surrenders' => $surrenders
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
        $surrender = Surrender::find($id);
        if ($surrender) {
            $surrender->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Surrender deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Surrender not found'
            ], 404);
        }
    }
}
