<div class="row mb-4">
    <label for="city_name" class="col-sm-2 col-form-label">أسم المدينه</label>
    <div class="col-sm-10">
        <input name="city_name" type="text" id="city_name" placeholder="ادخل أسم المدينه"
            value="{{ old('city_name', $city->city_name) }}"
            class="form-control @error('city_name') is-invalid @enderror">
        @error('city_name')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="country_id" class="col-sm-2 col-form-label">الدوله التابعه لها المدينه</label>
    <div class="col-sm-10">
        <select name="country_id" id="country_id" class="form-select @error('country_id') is-invalid @enderror">
            <option value="">برجاء أختيار الدوله التابعه لها المدينه المراد أضافتها</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}" @if ($country->id == old('country_id', $city->country_id)) selected @endif>
                    {{ $country->country_name }}</option>
            @endforeach
        </select>
        @error('country_id')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="text-center">
    <button type="submit" class="btn btn-success">حفظ</button>
</div>
