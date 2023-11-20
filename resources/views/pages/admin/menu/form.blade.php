@csrf
<div class="form-group">
    <label for="code" class="form-label">Kode</label>
    <input type="text" name="code" id="code" class="form-control" value="{{ isset($data['code']) ? $data['code'] : '' }}">
</div>
<div class="form-group">
    <label for="name" class="form-label">Menu Parent</label>
    <select name="parent_id" id="parent_id" class="form-control">
        <option value="" {{ isset($data['parent_id']) && $data['parent_id'] == '' ? 'selected' : '' }}>Pilih Menu Parent</option>
        @foreach ($menus as $menu)
            <option value="{{ $menu['id'] }}" {{ isset($data['parent_id']) && $data['parent_id'] == $menu['id'] ? 'selected' : '' }}>{{ $menu['name'] }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="name" class="form-label">Menu Header</label>
    <select name="menu_header_id" id="menu_header_id" class="form-control">
        <option value="" {{ isset($data['menu_header_id']) && $data['menu_header_id'] == '' ? 'selected' : '' }}>Pilih Menu Header</option>
        @foreach ($menu_headers as $menu_header)
            <option value="{{ $menu_header['id'] }}" {{ isset($data['menu_header_id']) && $data['menu_header_id'] == $menu_header['id'] ? 'selected' : '' }}>{{ $menu_header['name'] }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="name" class="form-label">Nama</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ isset($data['name']) ? $data['name'] : '' }}">
</div>
<div class="form-group">
    <label for="icon" class="form-label">Ikon</label>
    <input type="text" name="icon" id="icon" class="form-control" value="{{ isset($data['icon']) ? $data['icon'] : '' }}">
    <small>Untuk list ikon bisa dilihat di : <a href="https://feathericons.com" target="_blank">https://feathericons.com/</a></small>
</div>
<div class="form-group">
    <label for="link" class="form-label">Link</label>
    <input type="text" name="link" id="link" class="form-control" value="{{ isset($data['link']) ? $data['link'] : '' }}">
</div>
<div class="form-group">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea name="description" id="description" class="form-control" rows="8">{{ isset($data['description']) ? $data['description'] : '' }}</textarea>
</div>
