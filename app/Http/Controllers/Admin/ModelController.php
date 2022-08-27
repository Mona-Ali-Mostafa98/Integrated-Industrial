<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModelRequest;
use App\Models\AdModel;

class ModelController extends Controller
{
    public function index()
    {
        $models = AdModel::orderBy('year','asc')->paginate();
        return view('admin.models.index', compact('models'));
    }



    public function create()
    {
        $model = new AdModel();
        return view('admin.models.create' , compact('model'));
    }



    public function store(ModelRequest $request)
    {
        $data = $request->except('_token');

        AdModel::create($data);

        return redirect()->route('admin.models.index')
            ->with('success' , "تم الاضافه بنجاح");

    }



    public function show(AdModel $model)
    {
        return view('admin.models.show', compact('model') );
    }



    public function edit(AdModel $model)
    {
        return view('admin.models.edit', compact('model'));
    }



    public function update(ModelRequest $request , AdModel $model)
    {
        $data = $request->except('_token');

        $model->update($data);

        return redirect()->route('admin.models.index')
            ->with('success',"تم التعديل بنجاح");
    }


    public function destroy(AdModel $model)
    {
        $model -> delete();
        return redirect()->route('admin.models.index')
            ->with('success' , "تم الحذف بنجاح");
    }


}