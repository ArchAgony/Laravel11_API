@extends('layout.app')
@section('title', 'User')
@section('content')
    <h3>Halaman User</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama User</th>
                <th scope="col">Email User</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $no => $u)
            {{-- $key (dari controller) as $alias --}}
            <tr>
                <th scope="row">{{$user->firstItem() + $no}}</th>
                <td>{{ $u->name }}</td>
                {{-- // alias->nama_tabel --}}
                <td>{{ $u->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <span class="float-right">{{ $user->links() }}</span>
@endsection
