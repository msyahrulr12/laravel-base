@extends('layouts.admin.main')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h3>Edit Data {{ $title }}</h3>
            <div class="align-items-center">
                <a href="{{ route($baseRoute.'index') }}" class="btn btn-secondary">
                    <i class="align-middle" data-feather="arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route($baseRoute.'update', $data->id) }}" method="POST">
            @method('PUT')
            @include($baseView.'form')
            <button type="submit" class="btn btn-warning mt-3 btn-block w-100"><i class="align-middle" data-feather="edit"></i> Edit</button>
        </form>
    </div>
</div>

@endsection
