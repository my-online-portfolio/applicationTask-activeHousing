<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UrlshortenerController extends Controller
{

    /**
     * @Function: Fetches data from the recentTen view
     */
    private function getRecent10(){
        $recentList = DB::table('recentten')->get();
        return $recentList;
    }

    private function generateShortUrl(){

        return "http://sillysentence/".rand(0,9999);
    }
    
    public function index()
    {
        //render the main page with fields
        return view('shortener', ['recentList'=>$this->getRecent10()]);
    }

    public function show(){}
    public function store(){}
    public function update(){}
    public function delete(){}
    
    public function create()
    {
        $userSubmittedURL = request('urlInput');
        $URL = ['userURL'=>$userSubmittedURL, 'shortGeneratedURL'=>$this->generateShortUrl($userSubmittedURL)];

        //render the main page with fields
        return view('shortener', ['recentList'=>$this->getRecent10(), 'URL'=>$URL]);
    }
}
