<?php

namespace Luova\Contact\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use File;
use Luova\Contact\Http\Requests\ContactFV;
use Luova\Contact\Models\Contact;
use Luova\Contact\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function __construct()
    {
        // $this->middleware('outlet');
    }

    public function index(Request $request)
    {
        $mdata =  Contact::orderBy('id', 'DESC')->paginate(10);

        return view('contact::index')->with(['fdata' => null, 'mdata' => $mdata]);

        // return 'Contactlist';
    }
    public function view(Request $request, $id)
    {
        $mdata =  Contact::findOrFail($id);
        // dd($mdata);

        return view('contact::view')->with(['fdata' => $mdata, 'mdata' => $mdata]);

        // return 'Contactlist';
    }



    public function store(ContactFV $request)
    {

        //dd($request);
        $data = [
            'to_mail' => $request->to_mail,
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'mobile' => $request->mobile,
        ];

        try {

            Contact::create($data);

            Mail::to($request->to_mail)->send(new SendMail($data));

            return back()->with('success', 'Thanks for contacting us!');
        } catch (\Illuminate\Database\QueryException $ex) {

            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function delete($id)
    {
        $fdata = Contact::find($id);

        $fdata->delete();

        return redirect()->route('contact.index')->with('success', 'Successfully Delete');
    }
}
