<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $client = new Client();
        $url = env("API_URL");
        $idUser = 1;

        $review = json_decode($client->request("GET", $url . "/reviews")->getBody(), true)['data'];

        $reviews = collect([]);
        foreach ($review as $rvw) {
            if ($rvw['id_user'] == $idUser) {
                $reviews->push($rvw);
            }
        }

        return view("pages.users.review.index", compact('reviews'));
    }

    public function create()
    {
        return view('pages.users.review.create');
    }
}
