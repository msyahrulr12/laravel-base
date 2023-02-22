@extends('layouts.admin.main')
@section('content')

<div class="d-flex justify-content-between">
    <h1 class="h3 mb-3"><strong>Detail {{ $title }}</strong></h1>
    <div class="align-items-center">
        <a href="{{ route($baseRoute.'index') }}" class="btn btn-secondary">
            <i class="align-middle" data-feather="arrow-left"></i>
            <span>Kembali</span>
        </a>
        <a href="{{ route($baseRoute.'edit', $data->id) }}" class="btn btn-warning">
            <i class="align-middle" data-feather="edit"></i>
            <span>Edit</span>
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Detail Data {{ $title }}</h3>
    </div>
    <div class="card-body">
        <table class="table">
            <tbody>
                @foreach ($columns as $key => $column)
                <tr>
                    <th>{{ $column }}</th>
                    <td>{!! $data->$key !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
