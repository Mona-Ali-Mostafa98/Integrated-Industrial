<div class="row mb-4">
    <label for="region_name" class="col-sm-2 col-form-label">أسم المنطقه</label>
    <div class="col-sm-10">
        <input name="region_name" type="text" id="region_name" placeholder="ادخل أسم المنطقه"
            value="{{ old('region_name', $region->region_name) }}"
            class="form-control @error('region_name') is-invalid @enderror">
        @error('region_name')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="country_id" class="col-sm-2 col-form-label">الدوله التابعه لها</label>
    <div class="col-sm-10">
        <select name="country_id" id="country_id" class="form-select @error('country_id') is-invalid @enderror">
            <option value="">برجاء أختيار الدوله التابعه لها المنطقه المراد أضافتها </option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}" @if ($country->id == old('country_id', $region->country_id)) selected @endif>
                    {{ $country->country_name }}</option>
            @endforeach
        </select>
        @error('country_id')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="city_id" class="col-sm-2 col-form-label">المدينه التابعه لها</label>
    <div class="col-sm-10">
        <select name="city_id" id="city_id" class="form-select @error('city_id') is-invalid @enderror">
            {{-- this option to return city of region in edit form --}}
            <option value="{{ $city?->id }}" @if ($city?->id == old('city_id', $region?->city_id)) selected @endif>
                {{ $city?->city_name ?? 'برجاء أختيار المدينه التابعه لها المنطقه المراد أضافتها' }}</option>
        </select>
        @error('city_id')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="text-center">
    <button type="submit" class="btn btn-success">حفظ</button>
</div>
