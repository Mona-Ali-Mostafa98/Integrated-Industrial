<div class="row mb-4">
    <label for="name" class="col-sm-2 col-form-label"> الاسم </label>
    <div class="col-sm-10">
        <input name="name" type="text" id="name" placeholder="أدخل الاسم" value="{{ old('name', $admin->name) }}"
            class="form-control @error('name') is-invalid @enderror">
        @error('name')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="row mb-4">
    <label for="email" class="col-sm-2 col-form-label">البريد الالكترونى </label>
    <div class="col-sm-10">
        <input name="email" type="email" id="email" placeholder="ادخل عنوان البريدالالكترونى"
            value="{{ old('email', $admin->email) }}" class="form-control @error('email') is-invalid @enderror">
        @error('email')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="row mb-4">
    <label for="mobile" class="col-sm-2 col-form-label"> رقم الجوال </label>
    <div class="col-sm-10">
        <input name="mobile" type="text" id="mobile" placeholder="أدخل رقم الجوال"
            value="{{ old('mobile', $admin->mobile) }}" class="form-control @error('mobile') is-invalid @enderror">
        @error('mobile')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="row mb-4">
    <label for="roles_name" class="col-sm-2 col-form-label">صلاحيةالمشرف</label>
    <div class="col-sm-10">
        <select name="roles_name[]" id="roles_name" class="form-select" multiple>
            @foreach ($roles as $key => $role)
                <option value="{{ $role->name }}" @if (old("roles_name.$key", isset($admin->roles_name[$key]))) selected @endif>
                    {{ $role->name }}</option>
            @endforeach
        </select>
        @error('roles_name')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="row mb-4">
    <label for="status" class="col-sm-2 col-form-label">حالة المشرف</label>
    <div class="col-sm-10">
        <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="مفعل" @if ($admin->status == 'مفعل' or old('status') == 'مفعل') selected @endif>مفعل
            </option>
            <option value="غير مفعل" @if ($admin->status == 'غير مفعل' or old('status') == 'غير مفعل') selected @endif>غير مفعل
            </option>
        </select>
        @error('status')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="row mb-4">
    <label class="col-sm-2 col-form-label">الصوره</label>
    <div class="col-sm-10">
        <input name="image" type="file"
            onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
            class="form-control mb-3 @error('image') is-invalid @enderror" value="{{ old('image', $admin->image) }}">
        @error('image')
            <p class="invalid-feedback">{{ $message }}
            </p>
        @enderror
        <img id="image" src="{{ asset('storage/' . $admin->image) }}" style="height: 80px; width: 100px;"
            alt="no image uploaded">
    </div>
</div>
