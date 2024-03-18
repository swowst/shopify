<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $models = Contact::all();
        return view('backend.pages.contact.index', compact('models'));
    }

    public function destroy(Request $request)
    {
        $contact = Contact::where('id', $request->id)->firstOrFail();

        $contact->delete();

        return response(['error' => false, 'message' => 'Deleted successfully']);
    }

}
