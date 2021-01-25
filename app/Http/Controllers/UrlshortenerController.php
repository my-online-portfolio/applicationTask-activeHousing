<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UrlshortenerController extends Controller
{

    private $effWords = [];
    private $usedWords = [];

    //convert a stdClass object to array
    private function extractFromStdClass($object, $key){
        $returnArray = array();
        foreach($object as $extract){
            $returnArray[] = $extract->{$key};
        }
        return $returnArray;
    }

    //get the most recent 10 entries from the database
    private function getRecent10(){
        return DB::table('recentten')->get();//database call and return
    }

    //get the generated endpoints from the database
    private function getUsedGeneratedEndpoints(){
        $usedWords = DB::table('urlshorteners')->select('generated_url')->get();//database call
        return $this->usedWords = $this->extractFromStdClass($usedWords, 'words');//convert to array and return 
    }

    //get the effwords list from the database
    private function getEffWords(){
        $effWords = DB::table('effwords')->select('words')->get();//database call
        return $this->effWords = $this->extractFromStdClass($effWords, 'words');//convert to array and return 
    }

    private function compareEndPoints($new = null, $used = []){
        //loop through the used words list and look for a match

        foreach($used as $key=>$value){
            print_r($value->generated_url);
            echo "\r\n";
        }
        exit;
    }

    private function generateShortUrl($newWord = null){
        //get total amount of words to choose from
        $totalEffWords = count($this->effWords);

        

        die;

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

        
        header('Content-Type: text/plain');

        //capture user submitted url
        $userSubmittedURL = request('urlInput');
        //get generated endpoints
        $usedGeneratedEndpoints = $this->getUsedGeneratedEndpoints();
        //get listed effwords
        $getEffWords = $this->getEffWords();


        //generate new url endpoint



        $URL = ['userURL'=>$userSubmittedURL, 'shortGeneratedURL'=>$this->generateShortUrl($userSubmittedURL)];

        //render the main page with fields
        return view('shortener', ['recentList'=>$this->getRecent10(), 'URL'=>$URL]);
    }
}
