<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $profile = json_decode($client->request("GET", $url . "/users/" . $id)->getBody(), true)['data'];

        return view('pages.users.profile.index', compact('profile'));
    }

    public function update(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        if ($request->hasFile('profile') && !$request->password) {
            $response = json_decode($client->request("POST", $url . '/users/' . $id, [
                "multipart" => [
                    [
                        "name" => "name",
                        "contents" => $request->name
                    ],
                    [
                        "name" => "email",
                        "contents" => $request->email
                    ],
                    [
                        "name" => "profile",
                        "contents" => fopen($request->file('profile'), 'r'),
                        "filename" => $request->file('profile')->getClientOriginalName(),
                        "headers" => [
                            "Content-Type" => "<Content-type header>"
                        ]
                    ],
                ]
            ])->getBody(), true)['status'];
        } else if ($request->password && !$request->hasFile('profile')) {
            $response = json_decode($client->request("POST", $url . '/users/' . $id, [
                "multipart" => [
                    [
                        "name" => "name",
                        "contents" => $request->name
                    ],
                    [
                        "name" => "email",
                        "contents" => $request->email
                    ],
                    [
                        "name" => "password",
                        "contents" => $request->password
                    ]
                ]
            ])->getBody(), true)['status'];
        } else if ($request->hasFile('profile') && $request->password) {
            $response = json_decode($client->request("POST", $url . '/users/' . $id, [
                "multipart" => [
                    [
                        "name" => "name",
                        "contents" => $request->name
                    ],
                    [
                        "name" => "email",
                        "contents" => $request->email
                    ], [
                        "name" => "password",
                        "contents" => $request->password
                    ],
                    [
                        "name" => "profile",
                        "contents" => fopen($request->file('profile'), 'r'),
                        "filename" => $request->file('profile')->getClientOriginalName(),
                        "headers" => [
                            "Content-Type" => "<Content-type header>"
                        ]
                    ],
                ]
            ])->getBody(), true)['status'];
        } else {
            $response = json_decode($client->request("POST", $url . '/users/' . $id, [
                "multipart" => [
                    [
                        "name" => "name",
                        "contents" => $request->name
                    ],
                    [
                        "name" => "email",
                        "contents" => $request->email
                    ]
                ]
            ])->getBody(), true)['status'];
        }

        if ($response) {
            return redirect("/");
        } else {
            return redirect("/");
        }
    }

    public function adminindex(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");

        $users = json_decode($client->request("GET", $url . "/users")->getBody(), true)['data'];

        return view('pages.admin.account.index', compact('users'));
    }

    public function admincreate()
    {
        return view('pages.admin.account.create');
    }

    public function adminstore(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("POST", $url . "/users", [
            "multipart" => [
                [
                    "name" => "name",
                    "contents" => $request->name
                ],
                [
                    "name" => "email",
                    "contents" => $request->email
                ],
                [
                    "name" => "password",
                    "contents" => $request->password
                ], [
                    "name" => "profile",
                    "contents" => fopen($request->file('profile'), 'r'),
                    "filename" => $request->file('profile')->getClientOriginalName(),
                    "headers" => [
                        "Content-Type" => "<Content-type header>"
                    ]
                ]
            ]
        ])->getBody(), true);

        if ($response['status']) {
            return redirect('/admin/account');
        } else {
            dd($response);
        }
    }

    public function adminedit(String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $profile = json_decode($client->request("GET", $url . "/users/" . $id)->getBody(), true)['data'];

        return view('pages.admin.account.edit', compact('profile'));
    }

    public function adminupdate(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        if ($request->hasFile('profile') && !$request->password) {
            $response = json_decode($client->request("POST", $url . '/users/' . $id, [
                "multipart" => [
                    [
                        "name" => "name",
                        "contents" => $request->name
                    ],
                    [
                        "name" => "email",
                        "contents" => $request->email
                    ],
                    [
                        "name" => "profile",
                        "contents" => fopen($request->file('profile'), 'r'),
                        "filename" => $request->file('profile')->getClientOriginalName(),
                        "headers" => [
                            "Content-Type" => "<Content-type header>"
                        ]
                    ],
                ]
            ])->getBody(), true)['status'];
        } else if ($request->password && !$request->hasFile('profile')) {
            $response = json_decode($client->request("POST", $url . '/users/' . $id, [
                "multipart" => [
                    [
                        "name" => "name",
                        "contents" => $request->name
                    ],
                    [
                        "name" => "email",
                        "contents" => $request->email
                    ],
                    [
                        "name" => "password",
                        "contents" => $request->password
                    ]
                ]
            ])->getBody(), true)['status'];
        } else if ($request->hasFile('profile') && $request->password) {
            $response = json_decode($client->request("POST", $url . '/users/' . $id, [
                "multipart" => [
                    [
                        "name" => "name",
                        "contents" => $request->name
                    ],
                    [
                        "name" => "email",
                        "contents" => $request->email
                    ], [
                        "name" => "password",
                        "contents" => $request->password
                    ],
                    [
                        "name" => "profile",
                        "contents" => fopen($request->file('profile'), 'r'),
                        "filename" => $request->file('profile')->getClientOriginalName(),
                        "headers" => [
                            "Content-Type" => "<Content-type header>"
                        ]
                    ],
                ]
            ])->getBody(), true)['status'];
        } else {
            $response = json_decode($client->request("POST", $url . '/users/' . $id, [
                "multipart" => [
                    [
                        "name" => "name",
                        "contents" => $request->name
                    ],
                    [
                        "name" => "email",
                        "contents" => $request->email
                    ]
                ]
            ])->getBody(), true)['status'];
        }

        if ($response) {
            return redirect("/admin/account");
        } else {
            return redirect("/admin/account");
        }
    }

    public function admindelete(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("DELETE", $url . "/users/" . $id)->getBody(), true);

        if ($response['status']) {
            return redirect("/admin/account");
        }
    }
}
