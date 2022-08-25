<div class="row mb-4">
    <label for="category_name" class="col-sm-2 col-form-label"> أسم القسم </label>
    <div class="col-sm-10">
        <input name="category_name" type="text" id="category_name" placeholder="أدخل أسم القسم"
            value="{{ old('category_name', $category->category_name) }}"
            class="form-control @error('category_name') is-invalid @enderror">
        @error('category_name')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="parent_id" class="col-sm-2 col-form-label">القسم الرئيسى التابع له</label>
    <div class="col-sm-10">
        <select name="parent_id" id="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
            <option value="">لا يوجد</option>
            @foreach ($categories as $parent)
                <option value="{{ $parent->id }}" @if ($parent->id == old('parent_id', $category->parent_id)) selected @endif>
                    {{ $parent->category_name }}</option>
            @endforeach
        </select>
        @error('parent_id')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="category_order" class="col-sm-2 col-form-label">ترتيب القسم</label>
    <div class="col-sm-10">
        <select name="category_order" class="form-select @error('category_order') is-invalid @enderror"">
            <option value="">أختر ترتيب القسم أذا كان قسم فرعى</option>
            <option value="قسم رئيسى" @if ($category->category_order == 'قسم رئيسى' or old('category_order') == 'قسم رئيسى') selected @endif>قسم رئيسى
            </option>
            <option value="قسم فرعى" @if ($category->category_order == 'قسم فرعى' or old('category_order') == 'قسم فرعى') selected @endif>قسم فرعى
            </option>
            <option value="قسم فرعى من قسم فرعى أخر" @if ($category->category_order == 'قسم فرعى من قسم فرعى أخر' or
                old('category_order') == 'قسم فرعى من قسم فرعى أخر') selected @endif>قسم فرعى من قسم
                فرعى أخر
            </option>
        </select>
        @error('category_order')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="row mb-4">
    <label for="parent_id" class="col-sm-2 col-form-label">الحاله </label>
    <div class="col-sm-10">
        <select name="status" class="form-select @error('status') is-invalid @enderror"">
            <option value="عرض" @if ($category->status == 'عرض' or old('status') == 'عرض') selected @endif>عرض
            </option>
            <option value="أخفاء" @if ($category->status == 'أخفاء' or old('status') == 'أخفاء') selected @endif>أخفاء
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
        <input name="category_image" type="file"
            onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
            class="form-control mb-3 @error('category_image') is-invalid @enderror"
            value="{{ old('category_image', $category->category_image) }}">
        @error('category_image')
            <p class="invalid-feedback">{{ $message }}
            </p>
        @enderror
        <img id="image" src="{{ asset('storage/' . $category->category_image) }}"
            style="height: 100px; width: 150px;" alt="no category_image uploaded">
    </div>
</div>


<div class="text-center">
    <button type="submit" class="btn btn-success">حفظ</button>
</div>
