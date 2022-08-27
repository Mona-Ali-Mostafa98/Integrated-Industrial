<div class="row mb-4">
    <label for="first_name" class="col-sm-2 col-form-label"> الأسم الاول </label>
    <div class="col-sm-10">
        <input name="first_name" type="text" id="first_name" placeholder="أدخل الاسم الاول"
            value="{{ old('first_name', $user->first_name) }}"
            class="form-control @error('first_name') is-invalid @enderror">
        @error('first_name')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="last_name" class="col-sm-2 col-form-label"> الأسم الاخير </label>
    <div class="col-sm-10">
        <input name="last_name" type="text" id="last_name" placeholder="أدخل الاسم الاخير"
            value="{{ old('last_name', $user->last_name) }}"
            class="form-control @error('last_name') is-invalid @enderror">
        @error('last_name')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="email" class="col-sm-2 col-form-label"> البريد الالكترونى </label>
    <div class="col-sm-10">
        <input name="email" type="email" id="email" placeholder="أدخل البريد الالكترونى"
            value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror">
        @error('email')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="mobile" class="col-sm-2 col-form-label"> رقم الجوال </label>
    <div class="col-sm-10">
        <input name="mobile" type="text" id="mobile" placeholder="أدخل رقم الجوال"
            value="{{ old('mobile', $user->mobile) }}" class="form-control @error('mobile') is-invalid @enderror">
        @error('mobile')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="country_id" class="col-sm-2 col-form-label">أسم الدوله التابع لها المستخدم</label>
    <div class="col-sm-10">
        <select name="country_id" id="country_id" class="form-select @error('country_id') is-invalid @enderror">
            <option value="">برجاء أختيار الدوله التابعه لها المستخدم المراد أضافته </option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}" @if ($country->id == old('country_id', $user->country_id)) selected @endif>
                    {{ $country->country_name }}</option>
            @endforeach
        </select>
        @error('country_id')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="city_id" class="col-sm-2 col-form-label">أسم المدينه التابع لها المستخدم</label>
    <div class="col-sm-10">
        <select name="city_id" id="city_id" class="form-select @error('city_id') is-invalid @enderror">
            {{-- this option to return city of region in edit form --}}
            <option value="{{ $city?->id }}" @if ($city?->id == old('city_id', $user?->city_id)) selected @endif>
                {{ $city?->city_name ?? 'برجاء أختيار المدينه التابعه لها المستخدم المراد أضافته' }}</option>
        </select>
        @error('city_id')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="address" class="col-sm-2 col-form-label">العنوان بالتفصيل</label>
    <div class="col-sm-10">
        <textarea name="address" id="address" rows="2ٍٍ"
            placeholder="أذا كنت تريد أضافة عنوانك بشكل مفصل يمكنك أضافته هنا"
            class="col-sm-12 form-control @error('address') is-invalid @enderror">{{ old('address', $user->address) }}</textarea>
        @error('address')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="address_on_map" class="col-sm-2 col-form-label"> رابط موقع المستخدم الجغرافى </label>
    <div class="col-sm-10">
        <input name="address_on_map" type="text" id="address_on_map"
            placeholder="أدخل رابط لموقعك الجغرافى على الخريطه"
            value="{{ old('address_on_map', $user->address_on_map) }}"
            class="form-control @error('address_on_map') is-invalid @enderror">
        @error('address_on_map')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="details" class="col-sm-2 col-form-label">نبذه عن المستخدم</label>
    <div class="col-sm-10">
        <textarea name="details" id="details" rows="2ٍٍ"
            placeholder="أذا كنت تريد أضافة تفاصيل عن المستخدم يمكن اضافتها هنا "
            class="col-sm-12 form-control @error('details') is-invalid @enderror">{{ old('details', $user->details) }}</textarea>
        @error('details')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="status" class="col-sm-2 col-form-label">حالة المستخدم</label>
    <div class="col-sm-10">
        <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="مفعل" @if ($user->status == 'مفعل' or old('status') == 'مفعل') selected @endif>مفعل
            </option>
            <option value="غير مفعل" @if ($user->status == 'غير مفعل' or old('status') == 'غير مفعل') selected @endif>غير مفعل
            </option>
        </select>
        @error('status')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label class="col-sm-2 col-form-label">صوره للمستخدم</label>
    <div class="col-sm-10">
        <input name="profile_image" type="file"
            onchange="document.getElementById('profile_image').src = window.URL.createObjectURL(this.files[0])"
            class="form-control mb-3 @error('profile_image') is-invalid @enderror"
            value="{{ old('profile_image', $user->profile_image) }}">
        @error('profile_image')
            <p class="invalid-feedback">{{ $message }}
            </p>
        @enderror
        <img id="profile_image" src="{{ asset('storage/' . $user->profile_image) }}"
            style="height: 80px; width: 100px;" alt="no image uploaded">
    </div>
</div>
