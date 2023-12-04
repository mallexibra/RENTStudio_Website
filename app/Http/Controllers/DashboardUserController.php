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

        return view('pages.users.dashboard', compact('studios'));
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
        return view('pages.users.booking');
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
