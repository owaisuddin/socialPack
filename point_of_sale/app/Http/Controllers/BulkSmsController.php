<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Validator;

class BulkSmsController extends Controller
{
    public function sendSms( Request $request )
    {
        // Your Account SID and Auth Token from twilio.com/console
        $sid    = env( 'TWILIO_SID' );
        $token  = env( 'TWILIO_TOKEN' );

        $client = new Client( $sid, $token );
        $client->messages->create(
            '+18057997560',
            [
                'from' => env( 'TWILIO_FROM' ),
                'body' => "FXitRight iPhone Repair, Computer Repair, Tablet Repair, Cell Phone Repair in Oxnard CA would love your feedback. Post a review to our profile.\r\r\nReview On Google: https://g.page/FXitRight/review?is\r\r\n Review On yelp: https://www.yelp.com/biz/fxitright-oxnard-12?hrid=4UKSUYMeN0kMhJiKUyCWLQ&",
            ]
        );
        dd('sms sent');
//        $validator = Validator::make($request->all(), [
//            'numbers' => 'required',
//            'message' => 'required'
//        ]);

//        if ( $validator->passes() ) {

            $numbers_in_arrays = explode( ',' , $request->input( 'numbers' ) );

            $message = $request->input( 'message' );
            $count = 0;

            foreach( $numbers_in_arrays as $number )
            {
                $count++;

                $client->messages->create(
                    $number,
                    [
                        'from' => env( 'TWILIO_FROM' ),
                        'body' => $message,
                    ]
                );
            }

            return back()->with( 'success', $count . " messages sent!" );

//        } else {
//            return back()->withErrors( $validator );
//        }
    }
}
