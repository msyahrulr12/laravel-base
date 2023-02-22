@csrf
<div class="form-group">
    <label for="code" class="form-label">Kode</label>
    <input type="text" name="code" id="code" class="form-control" value="{{ isset($data['code']) ? $data['code'] : '' }}">
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="front_background_image" class="form-label">Background Kartu Depan</label>
        <input type="file" name="front_background_image" id="front_background_image" class="form-control" value="{{ isset($data['front_background_image']) ? $data['front_background_image'] : '' }}">
        @if (isset($data['front_background_image']))
            <small>
                Current File : <a href="{{ asset('storage/'.$data['front_background_image']) }}" target="_blank">{{ $data['front_background_image'] }}</a>
            </small>
        @endif
    </div>
</div>
<div class="form-group">
    <label for="profile_height" class="form-label">Tinggi Foto Profil</label>
    <input type="text" name="profile_height" id="profile_height" class="form-control" value="{{ isset($data['profile_height']) ? $data['profile_height'] : '' }}">
</div>
<div class="form-group">
    <label for="profile_width" class="form-label">Lebar Foto Profil</label>
    <input type="text" name="profile_width" id="profile_width" class="form-control" value="{{ isset($data['profile_width']) ? $data['profile_width'] : '' }}">
</div>
<div class="form-group">
    <label for="profile_position" class="form-label">Posisi Foto Profil</label>
    <select name="profile_position" id="profile_position" class="form-control" id="">
        <option value="" {{ isset($data['profile_position']) && $data['profile_position'] == '' ? 'selected' : '' }}>--Pilih Posisi--</option>
        <option value="top-left"  {{ isset($data['profile_position']) && $data['profile_position'] == 'top-left' ? 'selected' : '' }}>Atas Kiri</option>
        <option value="top"  {{ isset($data['profile_position']) && $data['profile_position'] == 'top' ? 'selected' : '' }}>Atas</option>
        <option value="top-right"  {{ isset($data['profile_position']) && $data['profile_position'] == 'top-right' ? 'selected' : '' }}>Atas Kanan</option>
        <option value="left"  {{ isset($data['profile_position']) && $data['profile_position'] == 'left' ? 'selected' : '' }}>Kiri</option>
        <option value="center"  {{ isset($data['profile_position']) && $data['profile_position'] == 'center' ? 'selected' : '' }}>Tengah</option>
        <option value="right"  {{ isset($data['profile_position']) && $data['profile_position'] == 'right' ? 'selected' : '' }}>Kanan</option>
        <option value="bottom-left"  {{ isset($data['profile_position']) && $data['profile_position'] == 'bottom-left' ? 'selected' : '' }}>Bawah Kiri</option>
        <option value="bottom"  {{ isset($data['profile_position']) && $data['profile_position'] == 'bottom' ? 'selected' : '' }}>Bawah</option>
        <option value="bottom-right"  {{ isset($data['profile_position']) && $data['profile_position'] == 'bottom-right' ? 'selected' : '' }}>Bawah Kanan</option>
    </select>
</div>
<div class="form-group">
    <label for="profile_offset_x" class="form-label">Posisi Offset X Foto Profil</label>
    <input type="text" name="profile_offset_x" id="profile_offset_x" class="form-control" value="{{ isset($data['profile_offset_x']) ? $data['profile_offset_x'] : '' }}">
</div>
<div class="form-group">
    <label for="profile_offset_y" class="form-label">Posisi Offset Y Foto Profil</label>
    <input type="text" name="profile_offset_y" id="profile_offset_y" class="form-control" value="{{ isset($data['profile_offset_y']) ? $data['profile_offset_y'] : '' }}">
</div>
<div class="form-group">
    <label for="qrcode_height" class="form-label">Tinggi Foto QR Code</label>
    <input type="text" name="qrcode_height" id="qrcode_height" class="form-control" value="{{ isset($data['qrcode_height']) ? $data['qrcode_height'] : '' }}">
</div>
<div class="form-group">
    <label for="qrcode_width" class="form-label">Lebar Foto QR Code</label>
    <input type="text" name="qrcode_width" id="qrcode_width" class="form-control" value="{{ isset($data['qrcode_width']) ? $data['qrcode_width'] : '' }}">
</div>
<div class="form-group">
    <label for="qrcode_position" class="form-label">Posisi Foto QR Code</label>
    <select name="qrcode_position" id="qrcode_position" class="form-control" id="qrcode_position">
        <option value="" {{ isset($data['qrcode_position']) && $data['qrcode_position'] == '' ? 'selected' : '' }}>--Pilih Posisi--</option>
        <option value="top-left"  {{ isset($data['qrcode_position']) && $data['qrcode_position'] == 'top-left' ? 'selected' : '' }}>Atas Kiri</option>
        <option value="top"  {{ isset($data['qrcode_position']) && $data['qrcode_position'] == 'top' ? 'selected' : '' }}>Atas</option>
        <option value="top-right"  {{ isset($data['qrcode_position']) && $data['qrcode_position'] == 'top-right' ? 'selected' : '' }}>Atas Kanan</option>
        <option value="left"  {{ isset($data['qrcode_position']) && $data['qrcode_position'] == 'left' ? 'selected' : '' }}>Kiri</option>
        <option value="center"  {{ isset($data['qrcode_position']) && $data['qrcode_position'] == 'center' ? 'selected' : '' }}>Tengah</option>
        <option value="right"  {{ isset($data['qrcode_position']) && $data['qrcode_position'] == 'right' ? 'selected' : '' }}>Kanan</option>
        <option value="bottom-left"  {{ isset($data['qrcode_position']) && $data['qrcode_position'] == 'bottom-left' ? 'selected' : '' }}>Bawah Kiri</option>
        <option value="bottom"  {{ isset($data['qrcode_position']) && $data['qrcode_position'] == 'bottom' ? 'selected' : '' }}>Bawah</option>
        <option value="bottom-right"  {{ isset($data['qrcode_position']) && $data['qrcode_position'] == 'bottom-right' ? 'selected' : '' }}>Bawah Kanan</option>
    </select>
</div>
<div class="form-group">
    <label for="qrcode_offset_x" class="form-label">Posisi Offset X Foto QR Code</label>
    <input type="text" name="qrcode_offset_x" id="qrcode_offset_x" class="form-control" value="{{ isset($data['qrcode_offset_x']) ? $data['qrcode_offset_x'] : '' }}">
</div>
<div class="form-group">
    <label for="qrcode_offset_y" class="form-label">Posisi Offset Y Foto QR Code</label>
    <input type="text" name="qrcode_offset_y" id="qrcode_offset_y" class="form-control" value="{{ isset($data['qrcode_offset_y']) ? $data['qrcode_offset_y'] : '' }}">
</div>
<div class="form-group">
    <label for="name_height" class="form-label">Tinggi Foto Nama</label>
    <input type="text" name="name_height" id="name_height" class="form-control" value="{{ isset($data['name_height']) ? $data['name_height'] : '' }}">
</div>
<div class="form-group">
    <label for="name_width" class="form-label">Lebar Foto Nama</label>
    <input type="text" name="name_width" id="name_width" class="form-control" value="{{ isset($data['name_width']) ? $data['name_width'] : '' }}">
</div>
<div class="form-group">
    <label for="name_position" class="form-label">Posisi Foto Nama</label>
    <select name="name_position" id="name_position" class="form-control" id="name_position">
        <option value="" {{ isset($data['name_position']) && $data['name_position'] == '' ? 'selected' : '' }}>--Pilih Posisi--</option>
        <option value="top-left"  {{ isset($data['name_position']) && $data['name_position'] == 'top-left' ? 'selected' : '' }}>Atas Kiri</option>
        <option value="top"  {{ isset($data['name_position']) && $data['name_position'] == 'top' ? 'selected' : '' }}>Atas</option>
        <option value="top-right"  {{ isset($data['name_position']) && $data['name_position'] == 'top-right' ? 'selected' : '' }}>Atas Kanan</option>
        <option value="left"  {{ isset($data['name_position']) && $data['name_position'] == 'left' ? 'selected' : '' }}>Kiri</option>
        <option value="center"  {{ isset($data['name_position']) && $data['name_position'] == 'center' ? 'selected' : '' }}>Tengah</option>
        <option value="right"  {{ isset($data['name_position']) && $data['name_position'] == 'right' ? 'selected' : '' }}>Kanan</option>
        <option value="bottom-left"  {{ isset($data['name_position']) && $data['name_position'] == 'bottom-left' ? 'selected' : '' }}>Bawah Kiri</option>
        <option value="bottom"  {{ isset($data['name_position']) && $data['name_position'] == 'bottom' ? 'selected' : '' }}>Bawah</option>
        <option value="bottom-right"  {{ isset($data['name_position']) && $data['name_position'] == 'bottom-right' ? 'selected' : '' }}>Bawah Kanan</option>
    </select>
</div>
<div class="form-group">
    <label for="name_offset_x" class="form-label">Posisi Offset X Foto Nama</label>
    <input type="text" name="name_offset_x" id="name_offset_x" class="form-control" value="{{ isset($data['name_offset_x']) ? $data['name_offset_x'] : '' }}">
</div>
<div class="form-group">
    <label for="name_offset_y" class="form-label">Posisi Offset Y Foto Nama</label>
    <input type="text" name="name_offset_y" id="name_offset_y" class="form-control" value="{{ isset($data['name_offset_y']) ? $data['name_offset_y'] : '' }}">
</div>
<div class="form-group">
    <label for="member_code_height" class="form-label">Tingi Foto Kode Member</label>
    <input type="text" name="member_code_height" id="member_code_height" class="form-control" value="{{ isset($data['member_code_height']) ? $data['member_code_height'] : '' }}">
</div>
<div class="form-group">
    <label for="member_code_width" class="form-label">Lebar Foto Kode Member</label>
    <input type="text" name="member_code_width" id="member_code_width" class="form-control" value="{{ isset($data['member_code_width']) ? $data['member_code_width'] : '' }}">
</div>
<div class="form-group">
    <label for="member_code_position" class="form-label">Posisi Foto Kode</label>
    <select name="member_code_position" id="member_code_position" class="form-control" id="member_code_position">
        <option value="" {{ isset($data['member_code_position']) && $data['member_code_position'] == '' ? 'selected' : '' }}>--Pilih Posisi--</option>
        <option value="top-left"  {{ isset($data['member_code_position']) && $data['member_code_position'] == 'top-left' ? 'selected' : '' }}>Atas Kiri</option>
        <option value="top"  {{ isset($data['member_code_position']) && $data['member_code_position'] == 'top' ? 'selected' : '' }}>Atas</option>
        <option value="top-right"  {{ isset($data['member_code_position']) && $data['member_code_position'] == 'top-right' ? 'selected' : '' }}>Atas Kanan</option>
        <option value="left"  {{ isset($data['member_code_position']) && $data['member_code_position'] == 'left' ? 'selected' : '' }}>Kiri</option>
        <option value="center"  {{ isset($data['member_code_position']) && $data['member_code_position'] == 'center' ? 'selected' : '' }}>Tengah</option>
        <option value="right"  {{ isset($data['member_code_position']) && $data['member_code_position'] == 'right' ? 'selected' : '' }}>Kanan</option>
        <option value="bottom-left"  {{ isset($data['member_code_position']) && $data['member_code_position'] == 'bottom-left' ? 'selected' : '' }}>Bawah Kiri</option>
        <option value="bottom"  {{ isset($data['member_code_position']) && $data['member_code_position'] == 'bottom' ? 'selected' : '' }}>Bawah</option>
        <option value="bottom-right"  {{ isset($data['member_code_position']) && $data['member_code_position'] == 'bottom-right' ? 'selected' : '' }}>Bawah Kanan</option>
    </select>
</div>
<div class="form-group">
    <label for="member_code_offset_x" class="form-label">Posisi Offset X Foto Kode Member</label>
    <input type="text" name="member_code_offset_x" id="member_code_offset_x" class="form-control" value="{{ isset($data['member_code_offset_x']) ? $data['member_code_offset_x'] : '' }}">
</div>
<div class="form-group">
    <label for="member_code_offset_y" class="form-label">Posisi Offset Y Foto Kode Member</label>
    <input type="text" name="member_code_offset_y" id="member_code_offset_y" class="form-control" value="{{ isset($data['member_code_offset_y']) ? $data['member_code_offset_y'] : '' }}">
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="back_background_image" class="form-label">Background Kartu Belakang</label>
        <input type="file" name="back_background_image" id="back_background_image" class="form-control" value="{{ isset($data['back_background_image']) ? $data['back_background_image'] : '' }}">
        @if (isset($data['back_background_image']))
            <small>
                Current File : <a href="{{ asset('storage/'.$data['back_background_image']) }}" target="_blank">{{ $data['back_background_image'] }}</a>
            </small>
        @endif
    </div>
</div>
