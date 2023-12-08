<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudioController extends Controller
{
    public function index()
    {
        try {
            $studios = Studio::all();

            for ($i = 0; $i < $studios->count(); $i++) {
                $studios[$i]['thumbnail'] = url('/thumbnails/' . $studios[$i]['thumbnail']);
            }

            return response()->json([
                "status" => true,
                "message" => "GET all data studio successfully",
                "data" => $studios
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "status" => false,
                    "message" => $e->getMessage()
                ]
            );
        }
    }

    public function show(String $id)
    {
        try {
            $studio = Studio::findOrFail($id);

            $studio['thumbnail'] = url('/thumbnails/' . $studio['thumbnail']);

            return response()->json([
                "status" => true,
                "message" => "GET data studio by id successfully",
                "data" => $studio
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "status" => false,
                    "message" => $e->getMessage()
                ]
            );
        }
    }

    public function store(Request $request)
    {
        try {
            $validator  = Validator::make($request->all(), [
                "nama" => "required",
                "deskripsi" => "required",
                "lokasi" => "required",
                "jam_buka" => "required",
                "jam_tutup" => "required",
                "harga" => "required",
                "status" => "required|in:tersedia,dipinjam,tidak_tersedia",
                "peralatan" => "required",
                "thumbnail" => "required|image|mimes:jpeg,jpg,png"
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "error_message" => $validator->errors()->all()
                ]);
            }

            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/thumbnails'), $fileName);
            }

            Studio::create([
                "nama" => $request->nama,
                "deskripsi" => $request->deskripsi,
                "lokasi" => $request->lokasi,
                "jam_buka" => $request->jam_buka,
                "jam_tutup" => $request->jam_tutup,
                "status" => $request->status,
                "harga" => $request->harga,
                "peralatan" => $request->peralatan,
                "thumbnail" => $fileName
            ]);

            // $tes = Studio

            return response()->json([
                "status" => true,
                "message" => "CREATE data studio successfully",
                "data_created" => [
                    "nama" => $request->nama,
                    "deskripsi" => $request->deskripsi,
                    "lokasi" => $request->lokasi,
                    "jam_buka" => $request->jam_buka,
                    "jam_tutup" => $request->jam_tutup,
                    "status" => $request->status,
                    "harga" => $request->harga,
                    "peralatan" => $request->peralatan,
                    "thumbnail" => url('/thumbnails/' . $fileName)
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "status" => false,
                    "message" => $e->getMessage()
                ]
            );
        }
    }

    public function update(Request $request, String $id)
    {
        try {
            $studio = Studio::findOrFail($id);

            $nama = $studio->nama;
            if ($request->nama) {
                $nama = $request->nama;
            }

            $deskripsi = $studio->deskripsi;
            if ($request->deskripsi) {
                $deskripsi = $request->deskripsi;
            }

            $lokasi = $studio->lokasi;
            if ($request->lokasi) {
                $lokasi = $request->lokasi;
            }

            $jam_buka = $studio->jam_buka;
            if ($request->jam_buka) {
                $jam_buka = $request->jam_buka;
            }

            $jam_tutup = $studio->jam_tutup;
            if ($request->jam_tutup) {
                $jam_tutup = $request->jam_tutup;
            }

            $harga = $studio->harga;
            if ($request->harga) {
                $harga = $request->harga;
            }

            $status = $studio->status;
            if ($request->status) {
                $status = $request->status;
            }

            $peralatan = $studio->peralatan;
            if ($request->peralatan) {
                $peralatan = $request->peralatan;
            }

            $thumbnail = $studio->thumbnail;
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                if ($studio->thumbnail) {
                    unlink(public_path('/thumbnails/' . $studio->thumbnail));
                }
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/thumbnails'), $fileName);
                $thumbnail = $fileName;
            }

            $studio->update(
                [
                    "nama" => $nama,
                    "deskripsi" => $deskripsi,
                    "lokasi" => $lokasi,
                    "jam_buka" => $jam_buka,
                    "jam_tutup" => $jam_tutup,
                    "harga" => $harga,
                    "status" => $status,
                    "peralatan" => $peralatan,
                    "thumbnail" => $thumbnail,
                ]
            );

            return response()->json([
                "status" => true,
                "message" => "EDIT data studio by id successfully",
                "data_edited" => [
                    "nama" => $nama,
                    "deskripsi" => $deskripsi,
                    "lokasi" => $lokasi,
                    "jam_buka" => $jam_buka,
                    "jam_tutup" => $jam_tutup,
                    "status" => $status,
                    "peralatan" => $peralatan,
                    "thumbnail" =>  url('/thumbnails/' . $thumbnail),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "status" => false,
                    "message" => $e->getMessage()
                ]
            );
        }
    }

    public function destroy(String $id)
    {
        try {
            $studio = Studio::findOrFail($id);

            if ($studio->thumbnail) {
                unlink(public_path('/thumbnails/' . $studio->thumbnail));
            }

            $studio->delete();

            return response()->json([
                "status" => true,
                "message" => "DELETE studio by id successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "status" => false,
                    "message" => $e->getMessage()
                ]
            );
        }
    }
}
