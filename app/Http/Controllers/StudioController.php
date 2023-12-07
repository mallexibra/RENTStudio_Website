<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client();
        $url =  env("API_URL");

        $response = json_decode($client->request("GET", $url . "/studios")->getBody(), true)['data'];

        return view('pages.admin.studio.index');
    }
}
