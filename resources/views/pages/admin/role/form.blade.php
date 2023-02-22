@csrf
<div class="form-group">
    <label for="name" class="form-label">Nama Role</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ isset($data['name']) ? $data['name'] : '' }}">
</div>

<br>
<h6>Permission</h5>
<div class="row">
    @foreach ($permissions as $permission)
        <div class="col-sm-4">
            <div class="form-check mt-2">
                <input class="form-check-input" name="permission_ids[]" type="checkbox" value="{{ $permission->name }}" id="permission_id_{{ $permission->id }}" {{ Auth::user()->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                <label class="form-check-label" for="permission_id_{{ $permission->id }}">
                {{ $permission->name }}
                </label>
            </div>
        </div>
    @endforeach
</div>
