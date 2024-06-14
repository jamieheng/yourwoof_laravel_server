<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class postController extends Controller
{
    //

    public function index()
    {
        $post = Post::all();
        if ($post->count() > 0) {
            return response()->json([
                'status' => 200,
                'posts' => $post
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No post found'
            ], 404);
        }
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'adopter_id' => 'nullable|integer',

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
            $post = Post::create([
                'user_id' => $request->user_id,
                'adopter_id' => $request->adopter_id,

                'pet_name' => $request->pet_name,
                'pet_breed' => $request->pet_breed,
                'pet_age' => $request->pet_age,
                'pet_gender_id' => $request->pet_gender_id,
                'pet_description' => $request->pet_description,
                'pet_img' => $request->pet_img,
                'pet_status' => $request->pet_status,
                'pet_cate_id' => $request->pet_cate_id,

            ]);

            if ($post) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Post created successfully'
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
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => 404,
                'message' => 'post not found'
            ], 404);
        }
        $validator = Validator::make($request->all(), [

            'adopter_id' => 'nullable|integer',
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
            $post->update([

                'adopter_id' => $request->adopter_id,

                'pet_name' => $request->pet_name,
                'pet_breed' => $request->pet_breed,
                'pet_age' => $request->pet_age,
                'pet_gender_id' => $request->pet_gender_id,
                'pet_description' => $request->pet_description,
                'pet_img' => $request->pet_img,
                'pet_status' => $request->pet_status,
                'pet_cate_id' => $request->pet_cate_id,

            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Post updated successfully'
            ], 200);
        }
    }


    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                'status' => 404,
                'message' => 'post not found'
            ], 404);
        } else {
            $post->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Post deleted successfully'
            ], 200);
        }
    }

    public function remove($id)
    {
        // Attempt to find the user by ID
        $post = Post::find($id);

        if (!$post) {
            // If user with the specified ID is not found, return a 404 response
            return response()->json([
                'status' => 404,
                'message' => 'Post not found'
            ], 404);
        }

        try {
            // Update the user's 'is_verified' field to 1
            $post->is_removed = 1;
            $post->save();

            // Return a success response with updated user details
            return response()->json([
                'status' => 200,
                'message' => 'Post removed successfully',
                'pets' => $post
            ], 200);
        } catch (\Exception $e) {
            // If an unexpected error occurs during the update process, return a 500 response
            return response()->json([
                'status' => 500,
                'message' => 'Failed to remove pet. Please try again later.'
            ], 500);
        }
    }

    public function valid($id)
    {
        // Attempt to find the user by ID
        $post = Post::find($id);

        if (!$post) {
            // If user with the specified ID is not found, return a 404 response
            return response()->json([
                'status' => 404,
                'message' => 'Post not found'
            ], 404);
        }

        try {
            // Update the user's 'is_verified' field to 1
            $post->is_invalid = 1;
            $post->save();

            // Return a success response with updated user details
            return response()->json([
                'status' => 200,
                'message' => 'Post verified successfully',
                'pets' => $post
            ], 200);
        } catch (\Exception $e) {
            // If an unexpected error occurs during the update process, return a 500 response
            return response()->json([
                'status' => 500,
                'message' => 'Failed to adopted pet. Please try again later.'
            ], 500);
        }
    }

    public function unvalid($id)
    {
        // Attempt to find the user by ID
        $post = Post::find($id);

        if (!$post) {
            // If user with the specified ID is not found, return a 404 response
            return response()->json([
                'status' => 404,
                'message' => 'Post not found'
            ], 404);
        }

        try {
            // Update the user's 'is_verified' field to 1
            $post->is_invalid = 0;
            $post->save();

            // Return a success response with updated user details
            return response()->json([
                'status' => 200,
                'message' => 'Post verified successfully',
                'pets' => $post
            ], 200);
        } catch (\Exception $e) {
            // If an unexpected error occurs during the update process, return a 500 response
            return response()->json([
                'status' => 500,
                'message' => 'Failed to adopted pet. Please try again later.'
            ], 500);
        }
    }

    public function adopted($id)
    {
        // Attempt to find the user by ID
        $post = Post::find($id);

        if (!$post) {
            // If user with the specified ID is not found, return a 404 response
            return response()->json([
                'status' => 404,
                'message' => 'Post not found'
            ], 404);
        }

        try {
            // Update the user's 'is_verified' field to 1
            $post->is_adopted = 1;
            $post->save();

            // Return a success response with updated user details
            return response()->json([
                'status' => 200,
                'message' => 'Post adopted successfully',
                'pets' => $post
            ], 200);
        } catch (\Exception $e) {
            // If an unexpected error occurs during the update process, return a 500 response
            return response()->json([
                'status' => 500,
                'message' => 'Failed to adopted pet. Please try again later.'
            ], 500);
        }
    }

    public function approved($id)
    {
        // Attempt to find the user by ID
        $post = Post::find($id);

        if (!$post) {
            // If user with the specified ID is not found, return a 404 response
            return response()->json([
                'status' => 404,
                'message' => 'Post not found'
            ], 404);
        }

        try {
            // Update the user's 'is_verified' field to 1
            $post->is_approved = 1;
            $post->save();

            // Return a success response with updated user details
            return response()->json([
                'status' => 200,
                'message' => 'Post approve successfully',
                'pets' => $post
            ], 200);
        } catch (\Exception $e) {
            // If an unexpected error occurs during the update process, return a 500 response
            return response()->json([
                'status' => 500,
                'message' => 'Failed to adopted pet. Please try again later.'
            ], 500);
        }
    }
}
