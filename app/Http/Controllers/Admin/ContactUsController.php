<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:قائمة تواصل معنا', ['only' => ['index']]);
        $this->middleware('permission:عرض تواصل معنا', ['only' => ['show']]);
        $this->middleware('permission:حذف تواصل معنا', ['only' => ['destroy']]);
    }

    public function index()
    {
        $contacts = ContactUs:: all() ;
        return view('admin.contact-us.index', compact('contacts'));
    }

    public function show(ContactUs $contact )
    {
        return view('admin.contact-us.show', compact('contact'));
    }

    public function destroy(ContactUs $contact)
    {
        $contact -> delete();
        return redirect()->route('admin.contact.index')
            ->with('success' , "Massage Deleted Successfully");
    }
}