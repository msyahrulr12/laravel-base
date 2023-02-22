@csrf
<div class="form-group">
    <label for="code" class="form-label">Kode</label>
    <input type="text" name="code" id="code" class="form-control" value="{{ isset($data['code']) ? $data['code'] : '' }}" required>
</div>
<div class="form-group">
    <label for="title" class="form-label">Judul</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ isset($data['title']) ? $data['title'] : '' }}" required>
</div>
<div class="form-group">
    <label for="content" class="form-label">Konten</label>
    <textarea name="content" id="content" class="form-control">{{ isset($data['content']) ? $data['content'] : '' }}</textarea>
</div>

