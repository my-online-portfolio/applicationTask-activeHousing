<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class urlFollowerController extends Controller
{
    //

    public function redirect($endpoint){
        //lookup the DB and get the information for this endpoint
        $endpointInformation = DB::table('urlshorteners')->where('generated_url', '=', $endpoint)->limit(1)->get();//database call
        $endpointInformation = json_decode($endpointInformation, true);

        $redirectURL = $endpointInformation[0]['user_url'];

        header('Content-Type: text/plain');
        header('Location: '.$redirectURL);
        print_r($endpointInformation[0]['user_url']);
        exit;
    }
}
