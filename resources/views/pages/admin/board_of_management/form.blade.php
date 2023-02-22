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
        <label for="image" class="form-label">Gambar</label>
        <input type="file" name="image" id="image" class="form-control" value="{{ isset($data['image']) ? $data['image'] : '' }}">
        @if (isset($data['image']))
        <small>
            Current File : <a href="{{ asset('storage/'.$data['image']) }}" target="_blank">{{ $data['image'] }}</a>
        </small>
        @endif
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="content" class="form-label">Konten</label>
        <textarea name="content" id="content" class="form-control" rows="8">{{ isset($data['content']) ? $data['content'] : '' }}</textarea>
    </div>
</div>