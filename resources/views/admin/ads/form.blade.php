<input name="user_id" type="text" value="@if ($user) {{ $user->id }} @endif " hidden>
@error('user_id')
    <p class="text-danger">{{ $message }}</p>
@enderror

<div class="row mb-4">
    <label for="category_id" class="col-sm-2 col-form-label">القسم الرئيسى</label>
    <div class="col-sm-10">
        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
            <option value="">برجاء أختيار القسم المراد نشر الأعلان به </option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if ($category->id == old('category_id', $ad->category_id)) selected @endif>
                    {{ $category->category_name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="subcategory_id" class="col-sm-2 col-form-label">القسم الفرعى </label>
    <div class="col-sm-10">
        <select name="subcategory_id" id="subcategory_id"
            class="form-select @error('subcategory_id') is-invalid @enderror">
            {{-- this option to return city of region in edit form --}}
            <option value="{{ $subcategory?->id }}" @if ($subcategory?->id == old('subcategory_id', $ad?->subcategory_id)) selected @endif>
                {{ $subcategory?->category_name ?? 'برجاء أختيار القسم الفرعى المراد نشر الاعلان به ' }}</option>
        </select>
        @error('subcategory_id')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="city_id" class="col-sm-2 col-form-label">المدينه</label>
    <div class="col-sm-10">
        <select name="city_id" id="city_id" class="form-select @error('city_id') is-invalid @enderror">
            <option value="">برجاء أختيار المدينه المراد نشر الأعلان بها </option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}" @if ($city->id == old('city_id', $ad->city_id)) selected @endif>
                    {{ $city->city_name }}</option>
            @endforeach
        </select>
        @error('city_id')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="region_id" class="col-sm-2 col-form-label">المنطقه</label>
    <div class="col-sm-10">
        <select name="region_id" id="region_id" class="form-select @error('region_id') is-invalid @enderror">
            {{-- this option to return region of region in edit form --}}
            <option value="{{ $region?->id }}" @if ($region?->id == old('region_id', $ad?->region_id)) selected @endif>
                {{ $region?->region_name ?? 'برجاء أختيار المنطقه المراد نشر الأعلان بها ' }}</option>

        </select>
        @error('region_id')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="model_id" class="col-sm-2 col-form-label">موديل الأعلان </label>
    <div class="col-sm-10">
        <select name="model_id" id="model_id" class="form-select @error('model_id') is-invalid @enderror">
            <option value="">برجاء أختيار موديل الأعلان </option>
            @foreach ($models as $model)
                <option value="{{ $model->id }}" @if ($model->id == old('model_id', $ad->model_id)) selected @endif>
                    {{ $model->year }}</option>
            @endforeach
        </select>
        @error('model_id')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="mobile" class="col-sm-2 col-form-label"> رقم الجوال</label>
    <div class="col-sm-10">
        <input name="mobile" type="text" id="mobile" placeholder="أدخل رقم الجوال"
            value="{{ old('mobile', $ad->mobile) }}" class="form-control @error('mobile') is-invalid @enderror">
        @error('price')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="price" class="col-sm-2 col-form-label"> تحديد السعر </label>
    <div class="col-sm-10">
        <input name="price" type="text" id="price" placeholder="أدخل السعر"
            value="{{ old('price', $ad->price) }}" class="form-control @error('price') is-invalid @enderror">
        @error('price')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="description" class="col-sm-2 col-form-label">الوصف</label>
    <div class="col-sm-10">
        <textarea name="description" id="description" rows="3" placeholder="ادخل الوصف"
            class="col-sm-12 form-control @error('description') is-invalid @enderror">{{ old('description', $ad->description) }}</textarea>
        @error('description')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label class="col-sm-2 col-form-label">الصوره</label>
    <div class="col-sm-10">
        <input id="fileupload" name="image[]" type="file" accept="image/*"
            class="form-control mb-3 @error('image') is-invalid @enderror"
            onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])" multiple>
        @foreach ($ad->images as $value)
            <img src="{{ $value->image_url }}" style="height: 80px; width: 100px;">
        @endforeach
        @error('image')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        {{-- this div for show image uploaded --}}
        <div id="dvPreview">
        </div>
    </div>

    <div class="row mb-4">
        <label>
            <input name="hide_mobile" type="checkbox" value="1" @if (old('hide_mobile') == '1') checked @endif>
            <span>أخفاء رقم الهاتف
            </span>
        </label>
        @error('hide_mobile')
            <p class="errors">{{ $message }}</p>
        @enderror
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-success">حفظ</button>
    </div>
