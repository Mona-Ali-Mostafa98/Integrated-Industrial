<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function store(ContactUsRequest $request)
    {
        $data = $request->all();

        $contact_us = ContactUs::create($data);

        return response()->json([
            'message' => 'تم أرسال رسالتك بنجاح ! شكرا لتواصلك  معنا',
            'contact_us' => $contact_us
        ] , 201);

    }
}
