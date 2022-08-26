<div class="row mb-4">
    <label for="country_name" class="col-sm-2 col-form-label">أسم الدوله</label>
    <div class="col-sm-10">
        <input name="country_name" type="text" id="country_name" placeholder="ادخل أسم الدوله"
            value="{{ old('country_name', $country->country_name) }}"
            class="form-control @error('country_name') is-invalid @enderror">
        @error('country_name')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="country_code" class="col-sm-2 col-form-label">كود الدوله</label>
    <div class="col-sm-10">
        <input name="country_code" type="text" id="country_code" placeholder="ادخل كود الدوله"
            value="{{ old('country_code', $country->country_code) }}"
            class="form-control @error('country_code') is-invalid @enderror">
        @error('country_code')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="text-center">
    <button type="submit" class="btn btn-success">حفظ</button>
</div>
