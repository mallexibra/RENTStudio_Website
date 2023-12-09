<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");
        $transaction = json_decode($client->request("GET", $url . '/transaksi', [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];
        return view("pages.users.riwayat.index", compact("transaction"));
    }

    public function adminindex(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");
        $transaction = json_decode($client->request("GET", $url . '/transaksi', [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];
        $no = 1;
        return view('pages.admin.payment.index', compact('transaction', 'no'));
    }

    public function editstatus(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("POST", $url . "/transaksi/" . $id, [
            "multipart" => [
                [
                    "name" => "status",
                    "contents" => $request->status
                ]
            ],
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true);

        if ($response['status']) {
            return redirect('/admin/payment');
        }
    }

    public function show(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $transaksi = json_decode($client->request("GET", $url . "/transaksi/" . $id, [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];

        return view('pages.admin.payment.show', compact('transaksi'));
    }
}
