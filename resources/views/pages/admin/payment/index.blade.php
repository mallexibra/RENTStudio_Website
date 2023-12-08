@extends('layout.admin')

@section('title', 'Studio Admin')

@section('content')
    <h1 class="text-purple fw-bold">Payments Page</h1>

    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama User</th>
                    <th scope="col">Studio</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Status</th>
                    <th scope="col">Waktu</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($transaction) > 0)
                    @foreach ($transaction as $item)
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td>{{ $item['user']['name'] }}</td>
                            <td>{{ $item['studios']['nama'] }}</td>
                            <td>Rp. {{ $item['harga'] }}</td>
                            @if ($item['status'] == 'pending')
                                <td><span class="badge text-bg-secondary">{{ $item['status'] }}</span></td>
                            @elseif($item['status'] == 'approved')
                                <td><span class="badge text-bg-success">{{ $item['status'] }}</span></td>
                            @elseif($item['status'] == 'unapproved')
                                <td><span class="badge text-bg-danger">{{ $item['status'] }}</span></td>
                            @elseif($item['status'] == 'finish')
                                <td><span class="badge text-bg-primary">{{ $item['status'] }}</span></td>
                            @elseif($item['status'] == 'finished')
                                <td><span class="badge text-bg-warning">{{ $item['status'] }}</span></td>
                            @endif
                            <td>{{ $item['date'] }}</td>
                            <td>
                                <a href="/admin/payment/{{ $item['id'] }}"
                                    class="btn w-100 btn-custom text-bg-secondary">Detail</a>
                                @if ($item['status'] == 'pending')
                                    <form action="/admin/payment/{{ $item['id'] }}" method="post">
                                        @method('POST')
                                        @csrf
                                        <input type="text" class="d-none" value="approved" name="status" id="status">
                                        <button type="submit" onclick="return confirm('Yakin akan di approved?')"
                                            class="btn w-100 my-2 btn-custom text-bg-success">Approved</button>
                                    </form>
                                    <form action="/admin/payment/{{ $item['id'] }}" method="post">
                                        @method('POST')
                                        @csrf
                                        <input type="text" class="d-none" value="unapproved" name="status"
                                            id="status">
                                        <button type="submit" onclick="return confirm('Yakin akan di unapproved?')"
                                            class="btn w-100 btn-custom text-bg-danger">Unapproved</button>
                                    </form>
                                @endif
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
