<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");

        $review = json_decode($client->request("GET", $url . "/reviews", [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];

        $reviews = collect([]);
        foreach ($review as $rvw) {
            if ($rvw['id_user'] == $request->session()->get('id_user')) {
                $rvw['users']['profile'] = url("/profiles/" . $rvw['users']['profile']);
                $reviews->push($rvw);
            }
        }

        return view("pages.users.review.index", compact('reviews'));
    }

    public function create(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $transaksi = json_decode($client->request("GET", $url . "/transaksi/" . $id, [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];

        $data =
            json_decode($client->request("GET", $url . "/studios/" . $transaksi['id_studio'], [
                "headers" => [
                    "Authorization" => "Bearer " . $request->session()->get('token')
                ]
            ])->getBody(), true)['data'];

        return view('pages.users.review.create', compact('data', 'transaksi'));
    }

    public function store(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("POST", $url . "/reviews", [
            "multipart" => [
                [
                    "name" => "id_user",
                    "contents" => $request->session()->get('id_user')
                ],
                [
                    "name" => "id_studio",
                    "contents" => $id
                ],
                [
                    "name" => "rating",
                    "contents" => $request->rating
                ],
                [
                    "name" => "deskripsi",
                    "contents" => $request->deskripsi
                ],
            ],
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true);

        if ($response['status']) {
            $res =  json_decode($client->request("POST", $url . "/transaksi/" . $request->id_transaksi, [
                "multipart" => [
                    [
                        "name" => "status",
                        "contents" => "finished"
                    ],
                ],
                "headers" => [
                    "Authorization" => "Bearer " . $request->session()->get('token')
                ]
            ])->getBody(), true);

            return redirect('/review');
        } else {
            return redirect('/review');
        }
    }

    public function adminindex(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");

        $studios = json_decode($client->request("GET", $url . "/studios", [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];

        return view('pages.admin.review.index', compact('studios'));
    }
}
