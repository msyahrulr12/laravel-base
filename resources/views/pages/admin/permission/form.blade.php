@csrf
<div class="form-group">
    <label for="name" class="form-label">Nama Permission</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ isset($data['name']) ? $data['name'] : '' }}">

    @if ($errors->any() && isset($errors->messages()['name']))
        @foreach ($errors->messages()['name'] as $errorMessage)
            <small class="text-danger underline">{{ $errorMessage }}</small>
        @endforeach
    @endif
</div>

@if ($create)
    <br>
    <div>
        <p>Dengan akses berikut : </p>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="access[list]" id="list" checked>
        <label class="form-check-label" for="list">
        List
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="access[show]" id="show" checked>
        <label class="form-check-label" for="show">
        Show
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="access[create]" id="create" checked>
        <label class="form-check-label" for="create">
        Create
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="access[edit]" id="edit" checked>
        <label class="form-check-label" for="edit">
        Edit
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="access[export]" id="export" checked>
        <label class="form-check-label" for="export">
        Export
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="access[delete]" id="delete" checked>
        <label class="form-check-label" for="delete">
        Delete
        </label>
    </div>
@endif
