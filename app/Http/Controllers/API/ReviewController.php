<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index()
    {
        try {
            $reviews = Review::with('users')->get();

            for ($i = 0; $i < $reviews->count(); $i++) {
                $reviews[$i]['users']['profile'] = url("/profiles/" . $reviews[$i]['users']['profile']);
            }
            return response()->json([
                "status" => true,
                "message" => "GET all data reviews successfully",
                "data" => $reviews
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function show(String $id)
    {
        try {
            $review = Review::findOrFail($id);

            return response()->json([
                "status" => true,
                "message" => "GET data review by id successfully",
                "data" => $review
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "id_studio" => "required|numeric",
                "rating" => "required|numeric",
                "deskripsi" => "required"
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "erros_message" => $validator->errors()->all()
                ], 422);
            }

            Review::create([
                "id_user" => $request->id_user,
                "id_studio" => $request->id_studio,
                "rating" => $request->rating,
                "deskripsi" => $request->deskripsi,
            ]);

            return response()->json([
                "status" => true,
                "message" => "CREATE data review successfully",
                "data_created" => $request->all()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, String $id)
    {
        try {
            $review = Review::findOrFail($id);

            $rating = $review->rating;
            if ($request->rating) {
                $rating = $request->rating;
            }

            $deskripsi = $review->deskripsi;
            if ($request->deskripsi) {
                $deskripsi = $request->deskripsi;
            }

            $review->update([
                "id_user" => $review->id_user,
                "id_studio" => $review->id_studio,
                "rating" => $rating,
                "deskripsi" => $deskripsi,
            ]);

            return response()->json([
                "status" => true,
                "message" => "EDIT data review by id successfully",
                "data_updated" => [
                    "id_user" => $review->id_user,
                    "id_studio" => $review->id_studio,
                    "rating" => $rating,
                    "deskripsi" => $deskripsi,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function destroy(String $id)
    {
        try {
            $review = Review::findOrFail($id);

            $review->delete();

            return response()->json([
                "status" => true,
                "message" => "DELETE data review by id successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
