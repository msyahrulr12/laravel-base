@csrf
<div class="form-group">
    <label for="name" class="form-label">Nama Permission</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ isset($data['name']) ? $data['name'] : '' }}">
</div>
