@csrf
<div class="form-group">
    <label for="code" class="form-label">Kode</label>
    <input type="text" name="code" id="code" class="form-control" value="{{ isset($data['code']) ? $data['code'] : '' }}">

    @if ($errors->any() && isset($errors->messages()['code']))
        @foreach ($errors->messages()['code'] as $errorMessage)
            <small class="text-danger underline">{{ $errorMessage }}</small>
        @endforeach
    @endif
</div>
<div class="form-group">
    <label for="name" class="form-label">Nama</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ isset($data['name']) ? $data['name'] : '' }}">

    @if ($errors->any() && isset($errors->messages()['name']))
        @foreach ($errors->messages()['name'] as $errorMessage)
            <small class="text-danger underline">{{ $errorMessage }}</small>
        @endforeach
    @endif
</div>
<div class="form-group">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea name="description" id="description" class="form-control" rows="8">{{ isset($data['description']) ? $data['description'] : '' }}</textarea>
</div>
