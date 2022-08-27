<div class="row mb-4">
    <label for="year" class="col-sm-2 col-form-label">سنة الموديل</label>
    <div class="col-sm-10">
        <input name="year" type="text" id="year" placeholder="ادخل سنة الموديل"
            value="{{ old('year', $model->year) }}" class="form-control @error('year') is-invalid @enderror">
        @error('year')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="text-center">
    <button type="submit" class="btn btn-success">حفظ</button>
</div>
