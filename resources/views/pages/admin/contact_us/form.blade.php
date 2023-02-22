@csrf
<div class="row mt-2">
    <div class="form-group col">
        <label for="code" class="form-label">Kode</label>
        <input type="text" name="code" id="code" class="form-control" value="{{ isset($data['code']) ? $data['code'] : '' }}" required>
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="phone_number" class="form-label">Nomor Telepon</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ isset($data['phone_number']) ? $data['phone_number'] : '' }}" required>
    </div>
    <div class="form-group col">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ isset($data['email']) ? $data['email'] : '' }}" required>
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="address" class="form-label">Alamat</label>
        <textarea name="address" id="address" class="form-control" rows="8">{{ isset($data['address']) ? $data['address'] : '' }}</textarea>
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea name="description" id="description" class="form-control" rows="8">{{ isset($data['description']) ? $data['description'] : '' }}</textarea>
    </div>
</div>
