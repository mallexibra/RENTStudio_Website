<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");

        $studios = json_decode($client->request("GET", $url . '/studios', [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];

        return view('pages.users.dashboard', compact('studios'));
    }

    public function show(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $studio = json_decode($client->request("GET", $url . "/studios/" . $id, [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];
        $data = json_decode($client->request("GET", $url . "/reviews", [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];

        $reviews = collect([]);
        foreach ($data as $item) {
            if ($item['id_studio'] == $id) {
                $item['users']['profile'] = url('/profiles/' . $item['users']['profile']);
                $reviews->push($item);
            }
        }

        return view('pages.users.show', compact('studio', 'reviews'));
    }

    public function booking(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $studio = json_decode($client->request("GET", $url . "/studios/" . $id, [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];

        return view('pages.users.booking', compact("studio", "id"));
    }

    public function bookingnow(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("POST", $url . "/transaksi", [
            "multipart" => [
                [
                    "name" => "id_user",
                    "contents" => $request->session()->get('id_user'),
                ],
                [
                    "name" => "id_studio",
                    "contents" => $id,
                ],
                [
                    "name" => "nama",
                    "contents" => $request->pesan,
                ],
                [
                    "name" => "harga",
                    "contents" => $request->harga,
                ],
                [
                    "name" => "bukti",
                    "contents" => fopen($request->file('bukti'), 'r'),
                    "filename" => $request->file('bukti')->getClientOriginalName(),
                    "headers" => [
                        "Content-Type" => "<Content-type header>"
                    ]
                ],
            ],
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true);

        echo ($response['status']);
        if ($response['status']) {
            return redirect("/");
        } else {
            return redirect("/");
        }
    }
}
