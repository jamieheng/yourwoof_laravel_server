<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class categoriesController extends Controller
{
    //

    public function index()
    {
        $category = Categories::all();
        if ($category->count() > 0) {
            return response()->json([
                'status' => 200,
                'category' => $category
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No category found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cate_name' => 'required|max:191',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $category = Categories::create([
                'cate_name' => $request->cate_name,
            ]);

            if ($category) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Category created successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $category = Categories::find($id);

        if (!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Category not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [

            'cate_name' => 'required|max:191',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $category->update([
                'id' => $request->id,
                'cate_name' => $request->cate_name,

            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Category updated successfully'
            ], 200);
        }
    }


    public function delete($id)
    {
        $category = Categories::find($id);
        if ($category) {
            // This will automatically delete all breeds associated with the category
            $category->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Category and associated breeds deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Category found'
            ], 404);
        }
    }
}
