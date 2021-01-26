<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UrlshortenerController extends Controller
{
    public function create()
    {
        //capture user submitted url
        $userSubmittedURL = request('urlInput');

        //remove when finished writing
        die('EOF');        
    }
}
