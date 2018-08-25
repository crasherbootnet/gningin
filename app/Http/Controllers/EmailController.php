<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
    public function send()
    {
        //$title = $request->input('title');
       // $content = $request->input('content');

        Mail::send('emails.email', ['title' => "ddd", 'content' => "dss"], function ($message)
        {

            $message->from('pinkinem@gmail.com', 'Christian Nwamba');

            $message->to('ong@yopmail.com');

        });

        return response()->json(['message' => 'Request completed']);
    }    
}
