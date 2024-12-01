@extends('layout.app')
@section('title', 'Home')
@section('content')
    <h1>Halaman student</h1>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">NIM</th>
            <th scope="col">Nama</th>
            <th scope="col">Gender</th>
            <th scope="col">Jurusan</th>
            <th scope="col">Keahlian</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($student as $item)
            <tr>
              <th scope="row">1</th>
              <td>{{ $item->nim }}</td>
              <td>{{ $item->nama }}</td>
              <td>{{ $item->gender }}</td>
              <td>{{ $item->jurusan }}</td>
              <td>{{ $item->keahlian }}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
@endsection
