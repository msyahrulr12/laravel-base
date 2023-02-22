@csrf
<div class="row mt-2">
    <div class="form-group col">
        <label for="banner" class="form-label">Banner</label>
        <input type="file" name="banner" id="banner" class="form-control" value="{{ isset($data['banner']) ? $data['banner'] : '' }}">
        @if (isset($data['banner']))
        <small>
            Current File : <a href="{{ asset('storage/'.$data['banner']) }}" target="_blank">{{ $data['banner'] }}</a>
        </small>
        @endif
    </div>
</div>
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
        <label for="content" class="form-label">Konten</label>
        <textarea name="content" id="content" class="form-control" rows="8">{{ isset($data['content']) ? $data['content'] : '' }}</textarea>
    </div>
</div>
