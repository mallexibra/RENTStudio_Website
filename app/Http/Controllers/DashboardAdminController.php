<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");

        $transaksis = json_decode($client->request("GET", $url . "/transaksi", [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];

        $saldo = 0;
        $totalTransaksi = 0;
        $totalTransaksiMasuk = 0;
        $totalTransaksiBerhasil = 0;

        foreach ($transaksis as $item) {
            $saldo += (int) $item['harga'];
            $totalTransaksi++;
            if ($item['status'] == "pending") {
                $totalTransaksiMasuk++;
            }

            if ($item['status'] != "pending" && $item['status'] != "unapproved") {
                $totalTransaksiBerhasil++;
            }
        }

        return view("pages.admin.dashboard", compact('transaksis', 'saldo', 'totalTransaksi', 'totalTransaksiMasuk', 'totalTransaksiBerhasil'));
    }
}
