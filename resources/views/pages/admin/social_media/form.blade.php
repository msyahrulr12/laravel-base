@csrf
<div class="row mt-2">
    <div class="form-group col">
        <label for="code" class="form-label">Kode</label>
        <input type="text" name="code" id="code" class="form-control" value="{{ isset($data['code']) ? $data['code'] : '' }}" required>
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="icon" class="form-label">Ikon</label>
        <input type="text" name="icon" id="icon" class="form-control" value="{{ isset($data['icon']) ? $data['icon'] : '' }}" required>
    </div>
    <small><a href="https://icons.getbootstrap.com#search" target="_blank">Lihat Ikon</a> (Contoh : bi bi-facebook)</small>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="name" class="form-label">Nama</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ isset($data['name']) ? $data['name'] : '' }}" required>
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="link" class="form-label">Link</label>
        <input type="text" name="link" id="link" class="form-control" value="{{ isset($data['link']) ? $data['link'] : '' }}" required>
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea name="description" id="description" class="form-control" rows="8">{{ isset($data['description']) ? $data['description'] : '' }}</textarea>
    </div>
</div>
