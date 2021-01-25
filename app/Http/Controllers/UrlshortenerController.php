<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UrlshortenerController extends Controller
{

    private $effWords = [];
    private $usedWords = [];

    /**
     * @Function: Fetches data from the recentTen view
     */
    private function getRecent10(){
        $recentList = DB::table('recentten')->get();
        return $recentList;
    }

    private function getUsedGeneratedEndpoints(){
        return $this->usedWords = DB::table('urlshorteners')->select('generated_url')->get();
    }

    private function getEffWords(){
        return $this->effWords = DB::table('effwords')->select('words')->get();
    }

    private function compareEndPoints($new = null, $used = []){
        //loop through the used words list and look for a match
        
    }

    private function generateShortUrl(){

        $usedGeneratedEndpoints = $this->getUsedGeneratedEndpoints();
        $getEffWords = $this->getEffWords();


        print_r($getEffWords);
        die;

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
