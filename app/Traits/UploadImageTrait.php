<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Str ;
trait UploadImageTrait {

    public function uploadImage(Request $request, $fieldname = 'image', $folder ) {

        if ($request->hasFile($fieldname) && $request->file($fieldname)->isValid()) {
            $image = $request->file($fieldname);
            $extension =  $image->getClientOriginalExtension() ;
            $imageName = time().rand(0,999). "." .$extension;
            return $image->storeAs($folder, $imageName ,'public'); //store images in public storage
        }
        return null;
    }

}
