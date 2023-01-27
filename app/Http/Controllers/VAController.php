<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class VAController extends Controller
{
    public function vaMidtrans(Request $request)
    {
        $client = new Client();
        $response = $client->post('https://api.sandbox.midtrans.com/v2/charge',
            [
                'headers'=>[
                    'Accept'=>'application/json',
                    'Authorization'=>'Basic U0ItTWlkLXNlcnZlci1UaF9PbjVrbkpkcTRLdVM4Z2lJV0lQeVg6',
                    'Content-Type'=>'application/json',
                ],
                'body'=> json_encode([
                    'payment_type'=>'bank_transfer',
                    'transaction_details'=>[
                        'order_id'=>'va-midtrans-'.time(),
                        'gross_amount'=>$request->price,
                    ],
                    'bank_transfer'=>[
                        'bank'=>$request->bank
                    ]
                ])       
            ],
        );


        $data = json_decode($response->getBody());
        return response()->json($data);
    }
}
