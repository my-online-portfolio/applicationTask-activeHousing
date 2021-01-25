<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class urlFollowerController extends Controller
{
    //

    public function redirect($endpoint){
        //lookup the DB and get the information for this endpoint
        $endpointInformation = DB::table('urlshorteners')
                                ->where('generated_url', '=', $endpoint)
                                ->limit(1)
                                ->get();//database call
        $endpointInformation = json_decode($endpointInformation, true)[0];

        $endpointUUID = $endpointInformation['uuid'];
        $endpointRedirectURL = $endpointInformation['generated_url'];
        $endpointUserURL = $endpointInformation['user_url'];
        $endpointDescription = $endpointInformation['description'];
        $endpointCounter = $endpointInformation['counter'];
        $endpointDateAdded = $endpointInformation['date_added'];
        $endpointDateUpdated = $endpointInformation['date_updated'];

        //update the counter before issuing a redirect
        $endpointUpdate = DB::table('urlshorteners')
                            ->where('uuid', $endpointUUID)
                             ->increment('counter');
        header('Location: '.$redirectURL);
        exit;
    }
}
