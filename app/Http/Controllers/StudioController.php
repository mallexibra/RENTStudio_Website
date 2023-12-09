<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class StudioController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client();
        $url =  env("API_URL");

        $studio = json_decode($client->request("GET", $url . "/studios", [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];

        $no = 1;

        return view('pages.admin.studio.index', compact('studio', 'no'));
    }

    public function create()
    {
        return view('pages.admin.studio.create');
    }

    public function store(Request $request)
    {
        $client = new Client();
        $url =  env("API_URL");
        $response = json_decode($client->request("POST", $url . "/studios", [
            "multipart" => [
                [
                    "name" => "nama",
                    "contents" => $request->nama
                ],
                [
                    "name" => "deskripsi",
                    "contents" => $request->deskripsi
                ],
                [
                    "name" => "lokasi",
                    "contents" => $request->lokasi
                ],
                [
                    "name" => "harga",
                    "contents" => $request->harga
                ],
                [
                    "name" => "jam_buka",
                    "contents" => $request->jam_buka
                ],
                [
                    "name" => "jam_tutup",
                    "contents" => $request->jam_tutup
                ],
                [
                    "name" => "status",
                    "contents" => "tersedia"
                ],
                [
                    "name" => "peralatan",
                    "contents" => $request->peralatan
                ], [
                    "name" => "thumbnail",
                    "contents" => fopen($request->file('thumbnail'), 'r'),
                    "filename" => $request->file('thumbnail')->getClientOriginalName(),
                    "headers" => [
                        "Content-Type" => "<Content-type header>"
                    ]
                ]
            ],
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true);

        if ($response['status']) {
            return redirect("/admin/studio");
        }

        return;
    }

    public function edit(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $studio = json_decode($client->request("GET", $url . "/studios/" . $id, [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];

        return view('pages.admin.studio.edit', compact('studio'));
    }

    public function update(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        if ($request->hasFile('thumbnail')) {
            $response = json_decode($client->request("POST", $url . "/studios/" . $id, [
                "multipart" => [
                    [
                        "name" => "nama",
                        "contents" => $request->nama
                    ],
                    [
                        "name" => "deskripsi",
                        "contents" => $request->deskripsi
                    ],
                    [
                        "name" => "lokasi",
                        "contents" => $request->lokasi
                    ],
                    [
                        "name" => "harga",
                        "contents" => $request->harga
                    ],
                    [
                        "name" => "jam_buka",
                        "contents" => $request->jam_buka
                    ],
                    [
                        "name" => "jam_tutup",
                        "contents" => $request->jam_tutup
                    ],
                    [
                        "name" => "status",
                        "contents" => "tersedia"
                    ],
                    [
                        "name" => "peralatan",
                        "contents" => $request->peralatan
                    ], [
                        "name" => "thumbnail",
                        "contents" => fopen($request->file('thumbnail'), 'r'),
                        "filename" => $request->file('thumbnail')->getClientOriginalName(),
                        "headers" => [
                            "Content-Type" => "<Content-type header>"
                        ]
                    ]
                ],
                "headers" => [
                    "Authorization" => "Bearer " . $request->session()->get('token')
                ]
            ])->getBody(), true);
        } else {
            $response = json_decode($client->request("POST", $url . "/studios/" . $id, [
                "multipart" => [
                    [
                        "name" => "nama",
                        "contents" => $request->nama
                    ],
                    [
                        "name" => "deskripsi",
                        "contents" => $request->deskripsi
                    ],
                    [
                        "name" => "lokasi",
                        "contents" => $request->lokasi
                    ],
                    [
                        "name" => "harga",
                        "contents" => $request->harga
                    ],
                    [
                        "name" => "jam_buka",
                        "contents" => $request->jam_buka
                    ],
                    [
                        "name" => "jam_tutup",
                        "contents" => $request->jam_tutup
                    ],
                    [
                        "name" => "status",
                        "contents" => "tersedia"
                    ],
                    [
                        "name" => "peralatan",
                        "contents" => $request->peralatan
                    ]
                ],
                "headers" => [
                    "Authorization" => "Bearer " . $request->session()->get('token')
                ]
            ])->getBody(), true);
        }

        if ($response['status']) {
            return redirect('/admin/studio');
        }
    }

    public function destroy(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("DELETE", $url . "/studios/" . $id, [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true);

        if ($response['status']) {
            return redirect("/admin/studio");
        }
    }
}
