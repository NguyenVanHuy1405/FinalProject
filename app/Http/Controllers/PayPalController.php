<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Session;

class PayPalController extends Controller
{
   public function createTransaction()
   {
       return view('checkout.paypal');
   }

   /**
    * process transaction.
    *
    * @return \Illuminate\Http\Response
    */
   public function processTransaction(Request $request)
   {
       $total = Session::get('total_payment');
       $provider = new PayPalClient;
       $provider->setApiCredentials(config('paypal'));
       $paypalToken = $provider->getAccessToken();

       $response = $provider->createOrder([
           "intent" => "CAPTURE",
           "application_context" => [
               "return_url" => route('successTransaction'),
               "cancel_url" => route('cancelTransaction'),
           ],
           "purchase_units" => [
               0 => [
                   "amount" => [
                       "currency_code" => "USD",
                       "value" => $total
                   ]
               ]
           ]
       ]);

       if (isset($response['id']) && $response['id'] != null) {

           // redirect to approve href
           foreach ($response['links'] as $links) {
               if ($links['rel'] == 'approve') {
                   return redirect()->away($links['href']);
               }
           }

           return redirect()
               ->route('checkout')
               ->with('error', 'Something went wrong.');

       } else {
           return redirect()
               ->route('checkout')
               ->with('error', $response['message'] ?? 'Something went wrong.');
       }
   }

   /**
    * success transaction.
    *
    * @return \Illuminate\Http\Response
    */
   public function successTransaction(Request $request)
   {
       $provider = new PayPalClient;
       $provider->setApiCredentials(config('paypal'));
       $provider->getAccessToken();
       $response = $provider->capturePaymentOrder($request['token']);

       if (isset($response['status']) && $response['status'] == 'COMPLETED') {
        Session::put('successTransaction', true);
           return redirect()
               ->route('checkout')
               ->with('success', 'Transaction complete.');
       } else {
           return redirect()
               ->route('checkout')
               ->with('error', $response['message'] ?? 'Something went wrong.');
       }
   }

   /**
    * cancel transaction.
    *
    * @return \Illuminate\Http\Response
    */
   public function cancelTransaction(Request $request)
   {
       return redirect()
           ->route('checkout')
           ->with('error', $response['message'] ?? 'You have canceled the transaction.');
   }
}
