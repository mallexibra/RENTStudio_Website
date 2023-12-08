<?php

namespace App\Http\Controllers\API;

use DateTime;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function convertDate($inputDate)
    {
        try {
            $date = new DateTime($inputDate);

            $formattedDate = $date->format('j F Y | H:i:s');

            return $formattedDate;
        } catch (\Exception $e) {
            return 'Error parsing date: ' . $e->getMessage();
        }
    }
    public function index()
    {

        try {
            $transaksi = Transaksi::with(['user', 'studios'])->get();
            for ($i = 0; $i < $transaksi->count(); $i++) {
                $transaksi[$i]['bukti'] = url('/bukti/' . $transaksi[$i]['bukti']);
                $transaksi[$i]['studios']['thumbnail'] = url('/bukti/' . $transaksi[$i]['studios']['thumbnail']);
                $transaksi[$i]['date'] = $this->convertDate($transaksi[$i]['created_at']);
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
            $transaksi = Transaksi::with(['user', 'studios'])->findOrFail($id);

            $transaksi['bukti'] = url('/bukti/' . $transaksi['bukti']);
            $transaksi['date'] = $this->convertDate($transaksi['created_at']);
            $transaksi['studios']['thumbnail'] = url('/bukti/' . $transaksi['studios']['thumbnail']);

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
                "harga" => "required",
                "status" => "nullable|in:pending,approved,unapproved"
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
                $file->move(public_path('/bukti'), $fileName);
            }

            Transaksi::create([
                "id_user" => $request->id_user,
                "id_studio" => $request->id_studio,
                "nama" => $request->nama,
                "harga" => $request->harga,
                "bukti" => $fileName,
                "status" => $request->status || "pending"
            ]);

            return response()->json([
                "status" => true,
                "message" => "CREATED data transaksi successfully",
                "data_created" => [
                    "id_user" => $request->id_user,
                    "id_studio" => $request->id_studio,
                    "nama" => $request->nama,
                    "harga" => $request->harga,
                    "bukti" => url('/thumbnails/' . $fileName),
                    "status" => $request->status || "pending"
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
                $bukti = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/thumbnails'), $bukti);
            }

            $transaksi->update([
                "nama" => $nama,
                "bukti" => $bukti,
                "status" => $status,
            ]);

            return response()->json(
                [
                    'status' => true,
                    "message" => "EDIT data transaksi by id successfully",
                    "data_edited" => [
                        "nama" => $nama,
                        "bukti" => url('/thumbnails/' . $bukti),
                        "status" => $status,
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
