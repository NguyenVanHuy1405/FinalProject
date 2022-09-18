<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Contact;
use App\Models\User;
use App\Http\Requests\ContactRequest;
use App\Jobs\SendEmailContactUs;
use Mail;
class ContactController extends Controller
{
    public function index(Request $request){
        $meta_keywords = "Royal, Royal Hotel";
        $meta_description ="Owning a chain of hotels stretching across Vietnam, meeting most of the needs of guests.";
        $url_canonical = $request->url();
        $meta_title = "Royal Hotel";
        return view('contact',compact('meta_keywords','meta_description','url_canonical','meta_title'));
    }
    public function send_contact(ContactRequest $request) {
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone_number' => $request->phone_number,
            'user_message' => $request->user_message,
        ]);
        $admin_role_id = Role::where('role_name', 'admin')->first()->id;
        $receivers = User::where('role_id',$admin_role_id)->get();
        // echo $receivers;
        //dispatch --> push a new job into the job queue (or dispatch the job)
        SendEmailContactUs::dispatch($contact, $receivers)->delay(now());
        return redirect()->back()->with('success','Thank you for contact us!');
    }
}
