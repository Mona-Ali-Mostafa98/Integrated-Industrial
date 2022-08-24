<div class="row mb-4">
    <label for="name" class="col-sm-2 col-form-label">أسم الصلاحيه </label>
    <div class="col-sm-10">
        <input name="name" type="text" id="name" placeholder="أدخل أسم الصلاحيه"
            value="{{ old('name', $role->name) }}" class="form-control @error('name') is-invalid @enderror">
        @error('name')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="row mb-4">
    <label for="permission" class="col-sm-2 col-form-label">الصلاحيات</label>
    <div class="col-sm-10">
        @foreach ($permissions as $permission)
            <label for="permission">
                <input type="checkbox" name="permission[{{ $permission->id }}]" value="{{ $permission->id }}"
                    class="me-2 mb-2 "
                    {{ is_array(old('permission')) && in_array($permission->id, old('permission')) ? 'checked ' : '' }}>
                <span>{{ $permission->name }}</span>
            </label>
        @endforeach
        @error('permission.*')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="text-center">
    <button type="submit" class="btn btn-success">حفظ</button>
</div>
