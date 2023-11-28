<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        try {
            $transaksi = Transaksi::all();

            for ($i = 0; $i < $transaksi->count(); $i++) {
                $transaksi[$i]['bukti'] = url(public_path('/bukti/' . $transaksi[$i]['bukti']));
            }

            return response()->json([
                "status" => true,
                "message" => "GET all data transaksi successfully",
                "data" => $transaksi
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
            $transaksi = Transaksi::findOrFail($id);

            $transaksi['bukti'] = url(public_path('/bukti/' . $transaksi['bukti']));

            return response()->json([
                "status" => true,
                "message" => "GET data transaksi by id successfully",
                "data" => $transaksi
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
                "nama" => "required",
                "bukti" => "required|image|mimes:jpeg,jpg,png",
                "status" => "required|in:pending,approved,unapproved"
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "error_message" => $validator->errors()->all()
                ]);
            }

            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/thumbnails'), $fileName);
            }

            Transaksi::create([
                "id_user" => $request->id_user,
                "id_studio" => $request->id_studio,
                "nama" => $request->nama,
                "bukti" => $fileName,
                "status" => $request->status
            ]);


            return response()->json([
                "status" => true,
                "message" => "CREATED data transaksi successfully",
                "data_created" => [
                    "id_user" => $request->id_user,
                    "id_studio" => $request->id_studio,
                    "nama" => $request->nama,
                    "bukti" => url(public_path('/thumbnails/' . $fileName)),
                    "status" => $request->status
                ]
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
            $transaksi = Transaksi::findOrFail($id);

            $nama = $transaksi->nama;
            if ($request->nama) {
                $nama = $request->nama;
            }

            $status = $transaksi->status;
            if ($request->status) {
                $status = $request->status;
            }

            $bukti = $transaksi->bukti;
            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');
                if ($transaksi->bukti) {
                    unlink(public_path('/thumbnails/' . $transaksi->bukti));
                }
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/thumbnails'), $fileName);
            }

            $transaksi->update([
                "nama" => $request->nama,
                "bukti" => $fileName,
                "status" => $request->status,
            ]);

            return response()->json(
                [
                    'status' => true,
                    "message" => "EDIT data transaksi by id successfully",
                    "data_edited" => [
                        "nama" => $request->nama,
                        "bukti" => url(public_path('/thumbnails/' . $fileName)),
                        "status" => $request->status,
                    ]
                ]
            );
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
            $transaksi = Transaksi::findOrFail($id);

            if ($transaksi->bukti) {
                unlink(public_path('/thumbnails/' . $transaksi->bukti));
            }

            $transaksi->delete();

            return response()->json([
                "status" => true,
                "message" => "DELETE data transaksi by id successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
