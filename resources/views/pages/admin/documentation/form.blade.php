@csrf
<div class="row mt-2">
    <div class="form-group col">
        <label for="code" class="form-label">Kode</label>
        <input type="text" name="code" id="code" class="form-control" value="{{ isset($data['code']) ? $data['code'] : '' }}" required>
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="title" class="form-label">Judul</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ isset($data['title']) ? $data['title'] : '' }}" required>
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea name="description" id="description" class="form-control" rows="8">{{ isset($data['description']) ? $data['description'] : '' }}</textarea>
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="file" class="form-label">File</label>
        <input type="file" name="file" id="file" class="form-control" value="{{ isset($data['file']) ? $data['file'] : '' }}">
        @if (isset($data['file']))
        <small>
            Current File : <a href="{{ asset('storage/'.$data['file']) }}" target="_blank">{{ $data['file'] }}</a>
        </small>
        @endif
    </div>
</div>
