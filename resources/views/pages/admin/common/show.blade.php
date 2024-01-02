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
    <div class="card-body">
        <table class="table">
            <tbody>
                @foreach ($columns as $key => $column)
                    <tr>
                        <th>{{ $column['title'] }}</th>
                        <td>
                            @if ($column['type'] == \App\Http\Controllers\Admin\BaseController::TYPE_TEXT)
                                {!! $data->$key !!}
                            @elseif ($column['type'] == \App\Http\Controllers\Admin\BaseController::TYPE_IMAGE)
                                <a href="{{ asset('storage/'.$data->$key) }}" target="_blank">
                                    <img src="{{ asset('storage/'.$data->$key) }}" width="150">
                                </a>
                            @elseif ($column['type'] == \App\Http\Controllers\Admin\BaseController::TYPE_FILE)
                                <a href="{{ asset('storage/'.$data->$key) }}" target="_blank">{{ $data->$key }}</a>
                            @elseif ($column['type'] == \App\Http\Controllers\Admin\BaseController::TYPE_LINK)
                                <a href="{{ $data->$key }}" target="_blank">{{ $data->$key }}</a>
                            @elseif ($column['type'] == \App\Http\Controllers\Admin\BaseController::TYPE_BELONGS_TO)
                                <table class="table">
                                    @foreach ($data->$key->toArray() as $k => $v)
                                    @dd($k, $v)
                                    <tr>
                                        <th>{!! $k !!}</th>
                                        <td>{!! $v !!}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            @elseif ($column['type'] == \App\Http\Controllers\Admin\BaseController::TYPE_MANY_TO_MANY)
                            <div class="row">
                                @foreach ($data->$key->toArray() as $k => $v)
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <table class="table">
                                                    @foreach ($v as $k1 => $v1)
                                                        @php
                                                            if (is_array($v1)) continue
                                                        @endphp
                                                        <tr>
                                                            <th>{!! $k1 !!}</th>
                                                            <td>{!! $v1 !!}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
