<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class tipsController extends Controller
{
    public function index()
    {
        $tips = Tips::all();
        if ($tips->count() > 0) {
            return response()->json([
                'status' => 200,
                'tips' => $tips
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No tip found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tip_title' => 'required|max:255',
            'tip_img' => 'required|max:255',
            'tip_description' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $tips = Tips::create([
                'tip_title' => $request->tip_title,
                'tip_img' => $request->tip_img,
                'tip_description' => $request->tip_description,

            ]);

            if ($tips) {
                return response()->json([
                    'status' => 200,
                    'message' => 'tip registered successfully'
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
        $tips = Tips::find($id);
        if ($tips) {
            $tips->delete();
            return response()->json([
                'status' => 200,
                'message' => 'tip deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'tip not found'
            ], 404);
        }
    }



    public function update(Request $request, $id)
    {
        $tips = Tips::find($id);

        if (!$tips) {
            return response()->json([
                'status' => 404,
                'message' => 'Pet not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'tip_title' => 'required|max:191',
            'tip_img' => 'required|max:255',
            'tip_description' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $tips->update([
                'tip_title' => $request->tip_title,

                'tip_img' => $request->tip_img,
                'tip_description' => $request->tip_description,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Pet updated successfully'
            ], 200);
        }
    }
}
