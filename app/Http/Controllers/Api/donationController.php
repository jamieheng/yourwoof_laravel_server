<?php

namespace App\Http\Controllers\Api;

use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class donationController extends Controller
{
    //
    //GET
    public function index()
    {
        $donation = Donation::all();
        if ($donation->count() > 0) {
            return response()->json([
                'status' => 200,
                'donations' => $donation
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No donation found'
            ], 404);
        }
    }
    //POST or Store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'donation_amount' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|max:999999',
            'donation_type' => 'required|integer',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $donation = Donation::create($request->all());

            if ($donation) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Donation registered successfully',
                    'donations' => $donation
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            }
        }
    }

    //GET donations by user_id
    public function getDonationByUserId($user_id)
    {
        $donations = Donation::where('user_id', $user_id)->get();
        if ($donations->count() > 0) {
            return response()->json([
                'status' => 200,
                'donations' => $donations
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ], 404);
        }
    }

    //GET donations by donation_cate_id
    public function getDonationByCateId($donation_cate_id)
    {
        $donations = Donation::where('donation_cate_id', $donation_cate_id)->get();
        if ($donations->count() > 0) {
            return response()->json([
                'status' => 200,
                'donations' => $donations
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Category not found'
            ], 404);
        }
    }

    //Update donation by donation_id
    public function update(Request $request, $donation_id)
    {
        // $donation = Donation::find($donation_id);

        // if (!$donation) {
        //     return response()->json([
        //         'status' => 404,
        //         'message' => 'Donation not found'
        //     ], 404);
        // }

        // $validator = Validator::make($request->all(), [

        //     'donation_name' => 'required|string|max:191',

        //     'donation_img' => 'required|string|max:255',
        //     'donation_description' => 'required|string',

        //     'donation_link' => 'required|string|max:255',

        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 422,
        //         'errors' => $validator->messages()
        //     ], 422);
        // } else {
        //     $donation->update([
        //         'donation_name' => $request->donation_name,
        //         'donation_img' => $request->donation_img,
        //         'donation_description' => $request->donation_description,
        //         'donation_link' => $request->donation_link,
        //     ]);

        //     return response()->json([
        //         'status' => 200,
        //         'message' => 'Donation updated successfully'
        //     ], 200);
        // }
    }

    public function destroy($donation_id)
    {
        $donation = Donation::find($donation_id);
        if ($donation) {
            $donation->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Donation deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Donation not found'
            ], 404);
        }
    }
}
