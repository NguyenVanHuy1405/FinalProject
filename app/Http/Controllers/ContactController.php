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
    public function send_contact(Request $request) {
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
        return redirect()->back()->with(['class' => 'success', 'message' => 'Thank you for contact us!']);
    }
    public function send_email(){
        $to_name = "Royal Hotel";
        $to_email ="huynvgcd191294@fpt.edu.vn";

        $data = array("name"=>"Mail from customers","body"=>"Mail send about booking room");
        Mail::send('mails.test_send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Test email');
            $message->from($to_email,$to_name);
        });
        return redirect()->back()->with(['class' => 'success', 'message' => 'Thank you for contact us!']);
    }
}
