@csrf

<div class="row mt-2">
    <div class="form-group col">
        <label for="code" class="form-label">Kode</label>
        <input type="text" name="code" id="code" class="form-control" value="{{ isset($data['code']) ? $data['code'] : '' }}">

        @if ($errors->any() && isset($errors->messages()['code']))
            @foreach ($errors->messages()['code'] as $errorMessage)
                <small class="text-danger underline">{{ $errorMessage }}</small>
            @endforeach
        @endif
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="name" class="form-label">Nama</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ isset($data['name']) ? $data['name'] : '' }}">

        @if ($errors->any() && isset($errors->messages()['name']))
            @foreach ($errors->messages()['name'] as $errorMessage)
                <small class="text-danger underline">{{ $errorMessage }}</small>
            @endforeach
        @endif
    </div>
    <div class="form-group col">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" id="email" class="form-control" value="{{ isset($data['email']) ? $data['email'] : '' }}">

        @if ($errors->any() && isset($errors->messages()['email']))
            @foreach ($errors->messages()['email'] as $errorMessage)
                <small class="text-danger underline">{{ $errorMessage }}</small>
            @endforeach
        @endif
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="short_name" class="form-label">Password</label>
        <input type="password" name="short_name" id="short_name" class="form-control" value="{{ isset($data['short_name']) ? $data['short_name'] : '' }}">

        @if ($errors->any() && isset($errors->messages()['password']))
            @foreach ($errors->messages()['password'] as $errorMessage)
                <small class="text-danger underline">{{ $errorMessage }}</small>
            @endforeach
        @endif
    </div>
    <div class="form-group col">
        <label for="re_enter_password" class="form-label">Re Enter Password</label>
        <input type="password" name="re_enter_password" id="re_enter_password" class="form-control">

        @if ($errors->any() && isset($errors->messages()['re_enter_password']))
            @foreach ($errors->messages()['re_enter_password'] as $errorMessage)
                <small class="text-danger underline">{{ $errorMessage }}</small>
            @endforeach
        @endif
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="phone_number" class="form-label">Nomor Telepon</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ isset($data['phone_number']) ? $data['phone_number'] : '' }}">

        @if ($errors->any() && isset($errors->messages()['phone_number']))
            @foreach ($errors->messages()['phone_number'] as $errorMessage)
                <small class="text-danger underline">{{ $errorMessage }}</small>
            @endforeach
        @endif
    </div>
    <div class="form-group col">
        <label for="birthplace" class="form-label">Tempat Lahir</label>
        <input type="text" name="birthplace" id="birthplace" class="form-control" value="{{ isset($data['birthplace']) ? $data['birthplace'] : '' }}">

        @if ($errors->any() && isset($errors->messages()['birthplace']))
            @foreach ($errors->messages()['birthplace'] as $errorMessage)
                <small class="text-danger underline">{{ $errorMessage }}</small>
            @endforeach
        @endif
    </div>
    <div class="form-group col">
        <label for="birthdate" class="form-label">Tanggal Lahir</label>
        <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{ isset($data['birthdate']) ? $data['birthdate'] : '' }}">

        @if ($errors->any() && isset($errors->messages()['birthdate']))
            @foreach ($errors->messages()['birthdate'] as $errorMessage)
                <small class="text-danger underline">{{ $errorMessage }}</small>
            @endforeach
        @endif
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="religion" class="form-label">Agama</label>
        <select name="religion" id="religion" class="form-control">
            <option value="" {{ isset($data['religion']) && $data['religion'] == '' ? 'selected' : '' }}>Pilih Agama</option>
            <option value="ISLAM" {{ isset($data['religion']) && $data['religion'] == 'ISLAM' ? 'selected' : '' }}>ISLAM</option>
            <option value="PROTESTAN" {{ isset($data['religion']) && $data['religion'] == 'PROTESTAN' ? 'selected' : '' }}>PROTESTAN</option>
            <option value="KATOLIK" {{ isset($data['religion']) && $data['religion'] == 'KATOLIK' ? 'selected' : '' }}>KATOLIK</option>
            <option value="BUDDHA" {{ isset($data['religion']) && $data['religion'] == 'BUDDHA' ? 'selected' : '' }}>BUDDHA</option>
            <option value="HINDU" {{ isset($data['religion']) && $data['religion'] == 'HINDU' ? 'selected' : '' }}>HINDU</option>
            <option value="KONGHUCU" {{ isset($data['religion']) && $data['religion'] == 'KONGHUCU' ? 'selected' : '' }}>KONGHUCU</option>
            <option value="LAINNYA" {{ isset($data['religion']) && $data['religion'] == 'LAINNYA' ? 'selected' : '' }}>LAINNYA</option>
        </select>

        @if ($errors->any() && isset($errors->messages()['religion']))
            @foreach ($errors->messages()['religion'] as $errorMessage)
                <small class="text-danger underline">{{ $errorMessage }}</small>
            @endforeach
        @endif
    </div>
    <div class="form-group col">
        <label for="education" class="form-label">Pendidikan</label>
        <select name="education" id="education" class="form-control">
            <option value="" {{ isset($data['education']) && $data['education'] == '' ? 'selected' : '' }}>Pilih Pendidikan</option>
            <option value="SD" {{ isset($data['education']) && $data['education'] == 'SD' ? 'selected' : '' }}>SD</option>
            <option value="SMP" {{ isset($data['education']) && $data['education'] == 'SMP' ? 'selected' : '' }}>SMP</option>
            <option value="SMA / SMK" {{ isset($data['education']) && $data['education'] == 'SMA / SMK' ? 'selected' : '' }}>SMA / SMK</option>
            <option value="D1" {{ isset($data['education']) && $data['education'] == 'D1' ? 'selected' : '' }}>D1</option>
            <option value="D2" {{ isset($data['education']) && $data['education'] == 'D2' ? 'selected' : '' }}>D2</option>
            <option value="D3" {{ isset($data['education']) && $data['education'] == 'D3' ? 'selected' : '' }}>D3</option>
            <option value="S1" {{ isset($data['education']) && $data['education'] == 'S1' ? 'selected' : '' }}>S1</option>
            <option value="S2" {{ isset($data['education']) && $data['education'] == 'S2' ? 'selected' : '' }}>S2</option>
            <option value="S3" {{ isset($data['education']) && $data['education'] == 'S3' ? 'selected' : '' }}>S3</option>
            <option value="LAINNYA" {{ isset($data['education']) && $data['education'] == 'LAINNYA' ? 'selected' : '' }}>LAINNYA</option>
        </select>

        @if ($errors->any() && isset($errors->messages()['education']))
            @foreach ($errors->messages()['education'] as $errorMessage)
                <small class="text-danger underline">{{ $errorMessage }}</small>
            @endforeach
        @endif
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="job" class="form-label">Pekerjaan</label>
        <input type="text" name="job" id="job" class="form-control" value="{{ isset($data['job']) ? $data['job'] : '' }}">

        @if ($errors->any() && isset($errors->messages()['job']))
            @foreach ($errors->messages()['job'] as $errorMessage)
                <small class="text-danger underline">{{ $errorMessage }}</small>
            @endforeach
        @endif
    </div>
    <div class="form-group col">
        <label for="skill" class="form-label">Keahlian</label>
        <input type="text" name="skill" id="skill" class="form-control" value="{{ isset($data['skill']) ? $data['skill'] : '' }}">

        @if ($errors->any() && isset($errors->messages()['skill']))
            @foreach ($errors->messages()['skill'] as $errorMessage)
                <small class="text-danger underline">{{ $errorMessage }}</small>
            @endforeach
        @endif
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="profile_image" class="form-label">Foto Profil</label>
        <input type="file" name="profile_image" id="profile_image" class="form-control" value="{{ isset($data['profile_image']) ? $data['profile_image'] : '' }}">
        @if (isset($data['profile_image']))
            <small>
                Current File : <a href="{{ asset('storage/'.$data['profile_image']) }}" target="_blank">{{ $data['profile_image'] }}</a>
            </small>
        @endif

        @if ($errors->any() && isset($errors->messages()['profile_image']))
            @foreach ($errors->messages()['profile_image'] as $errorMessage)
                <small class="text-danger underline">{{ $errorMessage }}</small>
            @endforeach
        @endif
    </div>
    <div class="form-group col">
        <label for="ktp_image" class="form-label">Foto KTP</label>
        <input type="file" name="ktp_image" id="ktp_image" class="form-control" value="{{ isset($data['ktp_image']) ? $data['ktp_image'] : '' }}">
        @if (isset($data['ktp_image']))
            <small>
                Current File : <a href="{{ asset('storage/'.$data['ktp_image']) }}" target="_blank">{{ $data['ktp_image'] }}</a>
            </small>
        @endif

        @if ($errors->any() && isset($errors->messages()['ktp_image']))
            @foreach ($errors->messages()['ktp_image'] as $errorMessage)
                <small class="text-danger underline">{{ $errorMessage }}</small>
            @endforeach
        @endif
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="status" class="form-label">Status</label><br>
        <input type="radio" name="status" id="status" value="1" {{ isset($data['status']) && null !== $data['status'] && $data['status'] == 1 ? 'checked' : '' }}> Aktif
        <input type="radio" name="status" id="status" value="1" {{ isset($data['status']) && null !== $data['status'] && $data['status'] == 0 ? 'checked' : '' }}> Tidak Aktif

        @if ($errors->any() && isset($errors->messages()['status']))
            @foreach ($errors->messages()['status'] as $errorMessage)
                <small class="text-danger underline">{{ $errorMessage }}</small>
            @endforeach
        @endif
    </div>
    <div class="form-group col">
        <label for="is_blocked" class="form-label">Blokir</label><br>
        <input type="radio" name="is_blocked" id="is_blocked" value="1" {{ isset($data['is_blocked']) && null !== $data['is_blocked'] && $data['is_blocked'] == 1 ? 'checked' : ''}}> Ya
        <input type="radio" name="is_blocked" id="is_blocked" value="0" {{ isset($data['is_blocked']) && null !== $data['is_blocked'] && $data['is_blocked'] == 0 ? 'checked' : '' }}> Tidak

        @if ($errors->any() && isset($errors->messages()['is_blocked']))
            @foreach ($errors->messages()['is_blocked'] as $errorMessage)
                <small class="text-danger underline">{{ $errorMessage }}</small>
            @endforeach
        @endif
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col">
        <label for="address" class="form-label">Alamat</label>
        <textarea name="address" id="address" class="form-control" rows="8">{{ isset($data['address']) ? $data['address'] : '' }}</textarea>

        @if ($errors->any() && isset($errors->messages()['address']))
            @foreach ($errors->messages()['address'] as $errorMessage)
                <small class="text-danger underline">{{ $errorMessage }}</small>
            @endforeach
        @endif
    </div>
</div>
