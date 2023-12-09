<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $profile = json_decode($client->request("GET", $url . "/users/" . $id, [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];

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
                ],
                "headers" => [
                    "Authorization" => "Bearer " . $request->session()->get('token')

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
                ],
                "headers" => [
                    "Authorization" => "Bearer " . $request->session()->get('token')

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
                ],
                "headers" => [
                    "Authorization" => "Bearer " . $request->session()->get('token')

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
                ],
                "headers" => [
                    "Authorization" => "Bearer " . $request->session()->get('token')
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

        $users = json_decode($client->request("GET", $url . "/users", [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];
        $no = 1;

        return view('pages.admin.account.index', compact('users', 'no'));
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
                    "name" => "role",
                    "contents" => "user"
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
            ],
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true);

        if ($response['status']) {
            return redirect('/admin/account');
        } else {
            dd($response);
        }
    }

    public function adminedit(Request $request, String $id)
    {
        $client = new Client();
        $url = env("API_URL");

        $profile = json_decode($client->request("GET", $url . "/users/" . $id, [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true)['data'];

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
                        "name" => "role",
                        "contents" => "user"
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
                ],
                "headers" => [
                    "Authorization" => "Bearer " . $request->session()->get('token')
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
                        "name" => "role",
                        "contents" => "user"
                    ],
                    [
                        "name" => "email",
                        "contents" => $request->email
                    ],
                    [
                        "name" => "password",
                        "contents" => $request->password
                    ]
                ],
                "headers" => [
                    "Authorization" => "Bearer " . $request->session()->get('token')
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
                        "name" => "role",
                        "contents" => "user"
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
                ],
                "headers" => [
                    "Authorization" => "Bearer " . $request->session()->get('token')
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
                        "name" => "role",
                        "contents" => "user"
                    ],
                    [
                        "name" => "email",
                        "contents" => $request->email
                    ]
                ],
                "headers" => [
                    "Authorization" => "Bearer " . $request->session()->get('token')
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

        $response = json_decode($client->request("DELETE", $url . "/users/" . $id, [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true);

        if ($response['status']) {
            return redirect("/admin/account");
        }
    }

    public function register()
    {
        return view('pages.register');
    }

    public function user_register(Request $request)
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
                    "name" => "role",
                    "contents" => "user"
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
            ],
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true);

        if ($response['status']) {
            return redirect('/login');
        } else {
            dd($response);
        }
    }

    public function login()
    {
        return view('pages.login');
    }

    public function user_login(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("POST", $url . '/login', [
            "multipart" => [
                [
                    "name" => "email",
                    "contents" => $request->email
                ],
                [
                    "name" => "password",
                    "contents" => $request->password
                ]
            ],
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')

            ]
        ])->getBody(), true);

        if ($response['status']) {
            session([
                "id_user" => $response['data']['id'],
                "fullname" => $response['data']['name'],
                "role" => $response['data']['role'],
                "token" => $response['token']
            ]);

            if ($response['data']['role'] == "admin") {
                return redirect('/admin');
            } else {
                return redirect('/');
            }
        }
    }

    public function user_logout(Request $request)
    {
        $client = new Client();
        $url = env("API_URL");

        $response = json_decode($client->request("GET", $url . "/logout", [
            "headers" => [
                "Authorization" => "Bearer " . $request->session()->get('token')
            ]
        ])->getBody(), true);

        if ($response['status']) {
            $request->session()->flush();
            return redirect('/login');
        }
    }
}
