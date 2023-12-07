<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        $url = env("API_URL");
        $transaction = json_decode($client->request("GET", $url . '/transaksi')->getBody(), true)['data'];
        return view("pages.users.riwayat.index", compact("transaction"));
    }

    public function adminindex(Request $request)
    {
        return view('pages.admin.payment.index');
    }
}
