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
<hr>
<div class="row mt-2">
    <div class="form-group col">
        <label for="vision_banner" class="form-label">Banner Visi</label>
        <input type="file" name="vision_banner" id="vision_banner" class="form-control" value="{{ isset($data['vision_banner']) ? $data['vision_banner'] : '' }}">
        @if (isset($data['vision_banner']))
        <small>
            Current File : <a href="{{ asset('storage/'.$data['vision_banner']) }}" target="_blank">{{ $data['vision_banner'] }}</a>
        </small>
        @endif
    </div>
</div>
<div class="row mt-2">
    <div class="form-group">
        <label for="vision_content" class="form-label">Isi Visi</label>
        <textarea name="vision_content" id="vision_content" class="form-control" rows="8">{{ isset($data['vision_content']) ? $data['vision_content'] : '' }}</textarea>
    </div>
</div>
<hr>
<div class="row mt-2">
    <div class="form-group col">
        <label for="mission_banner" class="form-label">Banner Misi</label>
        <input type="file" name="mission_banner" id="mission_banner" class="form-control" value="{{ isset($data['mission_banner']) ? $data['mission_banner'] : '' }}">
        @if (isset($data['mission_banner']))
        <small>
            Current File : <a href="{{ asset('storage/'.$data['mission_banner']) }}" target="_blank">{{ $data['mission_banner'] }}</a>
        </small>
        @endif
    </div>
</div>
<div class="row mt-2">
    <div class="form-group">
        <label for="mission_content" class="form-label">Isi Misi</label>
        <textarea name="mission_content" id="mission_content" class="form-control" rows="8">{{ isset($data['mission_content']) ? $data['mission_content'] : '' }}</textarea>
    </div>
</div>
