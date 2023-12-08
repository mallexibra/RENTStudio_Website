@extends('layout.admin')

@section('title', 'Studio Admin')

@section('content')
    <h1 class="text-purple fw-bold">Studios Page</h1>

    <div>
        <a href="/admin/studio/create" class="btn btn-purple mt-5 mb-2">Tambah Studio</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Thumbnail</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jam Buka</th>
                    <th scope="col">Jam Tutup</th>
                    <th scope="col">Status</th>
                    <th scope="col">Peralatan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($studio) > 0)
                    @foreach ($studio as $item)
                        @php
                            $alat = explode("\n", $item['peralatan']);
                        @endphp
                        <tr>
                            <th scope="row">1</th>
                            <td>
                                <img width="220" src="{{ $item['thumbnail'] }}" alt="Thumbnail">
                            </td>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ $item['lokasi'] }}</td>
                            <td>Rp. {{ $item['harga'] }}</td>
                            <td>{{ $item['jam_buka'] }}</td>
                            <td>{{ $item['jam_tutup'] }}</td>
                            <td>{{ $item['status'] }}</td>
                            <td>
                                <ul>
                                    @foreach ($alat as $i)
                                        <li>{{ $i }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <a class="btn btn-yellow d-block w-100"
                                    href="/admin/studio/edit/{{ $item['id'] }}">Edit</a>
                                <form action="/admin/studio/delete/{{ $item['id'] }}" method="post">
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
                        <td colspan="10">Data masih kosong...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
