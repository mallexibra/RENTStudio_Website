<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        $url = env("API_URL");

        $studios = json_decode($client->request("GET", $url . '/studios')->getBody(), true)['data'];
        $transaction = json_decode($client->request("GET", $url . '/transaksi')->getBody(), true)['data'];

        return view('pages.users.dashboard', compact('studios', 'transaction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $studio = json_decode($client->request("GET", $url . "/studios/" . $id)->getBody(), true)['data'];
        $data = json_decode($client->request("GET", $url . "/reviews")->getBody(), true)['data'];

        $reviews = collect([]);
        foreach ($data as $item) {
            if ($item['id_studio'] == $id) {
                $reviews->push($item);
            }
        }

        return view('pages.users.show', compact('studio', 'reviews'));
    }

    public function booking(String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $studio = json_decode($client->request("GET", $url . "/studios/" . $id)->getBody(), true)['data'];

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
                    "contents" => 1,
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
            ]
        ])->getBody(), true);

        echo ($response['status']);
        if ($response['status']) {
            return redirect("/");
        } else {
            return redirect("/");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
