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
        $idUser = 1;

        $review = json_decode($client->request("GET", $url . "/reviews", [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];

        $reviews = collect([]);
        foreach ($review as $rvw) {
            if ($rvw['id_user'] == $idUser) {
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

        $data = json_decode($client->request("GET", $url . "/studios/" . $id, [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];

        return view('pages.users.review.create', compact('data'));
    }

    public function store(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("POST", $url . "/reviews", [
            "multipart" => [
                [
                    "name" => "id_user",
                    "contents" => 1
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
