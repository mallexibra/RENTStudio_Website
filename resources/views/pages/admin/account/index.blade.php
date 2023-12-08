@extends('layout.admin')

@section('title', 'Studio Admin')

@section('content')
    <h1 class="text-purple fw-bold">Accounts Page</h1>

    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Profile</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($users) > 0)
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">1</th>
                            <td>
                                @if ($user['profile'])
                                    <img src="{{ $user['profile'] }}" alt="profile-image">
                                @else
                                    <img src="" alt="profile-icon">
                                @endif
                            </td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>
                                <a class="btn btn-yellow d-block w-100" href="/admin/user/edit/{{ $user['id'] }}">Edit</a>
                                <form action="/admin/user/delete/{{ $user['id'] }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-red mt-2 d-block w-100" onclick="return confirm('Are you sure?')"
                                        type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">Data masih kosong...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
