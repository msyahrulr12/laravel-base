@csrf
<div class="form-group">
    <label for="name" class="form-label">Nama Role</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ isset($data['name']) ? $data['name'] : '' }}">
    @if ($errors->any() && isset($errors->messages()['name']))
        @foreach ($errors->messages()['name'] as $errorMessage)
            <small class="text-danger underline">{{ $errorMessage }}</small>
        @endforeach
    @endif
</div>

<br>
<h6>Menu & Permission</h5>
<div class="row">
    @foreach ($menu_data as $menu)
        <div class="col-sm-12">
            <div class="form-check mt-2">
                <input class="form-check-input form-menu-ids" name="menu_ids[]" type="checkbox" value="{{ $menu['id'] }}" id="menu_id_{{ $menu['id'] }}" {{ count($current_menus) > 0 && count(array_filter($current_menus, function($arr) use ($menu) {
                    return $arr['name'] == $menu->name;
                })) > 0 ? 'checked' : '' }}>
                <label class="form-check-label" for="menu_id_{{ $menu['id'] }}">
                {{ $menu['name'] }}
                </label>

                <div class="row">
                    @foreach ($menu['permissions'] as $permission)
                        <div class="col-sm-4">
                            <div class="form-check mt-2">
                                <input class="form-check-input form-menu-permission-ids" name="permission_ids[]" type="checkbox" value="{{ $permission->name }}" id="permission_id_{{ $permission->id }}" {{ count($current_permissions) > 0 && count(array_filter($current_permissions, function($arr) use ($permission) {
                                    return $arr['name'] == $permission->name;
                                })) > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="permission_id_{{ $permission->id }}">
                                {{ $permission->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <br><br><br>
        </div>
        {{-- <div class="col-sm-4">
            <div class="form-check mt-2">
                <input class="form-check-input" name="permission_ids[]" type="checkbox" value="{{ $permission->name }}" id="permission_id_{{ $permission->id }}" {{ count($current_permissions) > 0 && array_filter($current_permissions, function($arr) use ($permission) {
                    return $arr['name'] == $permission->name;
                }) ? 'checked' : '' }}>
                <label class="form-check-label" for="permission_id_{{ $permission->id }}">
                {{ $permission->name }}
                </label>
            </div>
        </div> --}}
    @endforeach
</div>

{{-- <br>
<h6>Permission</h5>
<div class="row">
    @foreach ($permissions as $permission)
        <div class="col-sm-4">
            <div class="form-check mt-2">
                <input class="form-check-input" name="permission_ids[]" type="checkbox" value="{{ $permission->name }}" id="permission_id_{{ $permission->id }}" {{ count($current_permissions) > 0 && array_filter($current_permissions, function($arr) use ($permission) {
                    return $arr['name'] == $permission->name;
                }) ? 'checked' : '' }}>
                <label class="form-check-label" for="permission_id_{{ $permission->id }}">
                {{ $permission->name }}
                </label>
            </div>
        </div>
    @endforeach
</div> --}}
