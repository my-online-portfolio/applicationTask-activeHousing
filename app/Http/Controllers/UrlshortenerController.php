<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UrlshortenerController extends Controller
{

    private $effWords = [];
    private $usedWords = [];
    private $useableWords = [];
    private $endpointRegenerateCount = 0;
    private $endpointWordCount = 1;
    private $effWordLastUsedKey = 0;

    private function resetDefaultValues(){

        $this->effWords = [];
        $this->usedWords = [];
        $this->useableWords = [];
        $this->endpointRegenerateCount = 0;
        $this->endpointWordCount = 1;
        $this->effWordLastUsedKey = 0;

        return true;
    }

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
        $updatedArray = $this->extractFromStdClass($usedWords, 'generated_url');//convert to array and return 
        $mergeArray = array_merge($this->usedWords, $updatedArray);
        $mergeArray = array_unique($mergeArray);
        $this->usedWords = $mergeArray;
        return $this->usedWords;
    }

    //get the effwords list from the database
    private function getEffWords(){
        $effWords = DB::table('effwords')->select('words')->get();//database call
        return $this->effWords = $this->extractFromStdClass($effWords, 'words');//convert to array and return 
    }


    
    public function index()
    {
        //render the main page with fields
        return view('shortener', ['recentList'=>$this->getRecent10()]);
    }

    public function show(){}
    public function store($userSubmittedURL, $newEndpoint){
        $newInsert = [
            'user_url' => $userSubmittedURL,
            'generated_url' => $newEndpoint
        ];
        return DB::table('urlshorteners')->insert($newInsert);
    }
    public function update(){}
    public function delete(){}
    
    private function generateNewEndpoint(){
        die;
    }

    public function create()
    {
        //capture user submitted url
        $userSubmittedURL = request('urlInput');
        //get generated endpoints
        $usedGeneratedEndpoints = $this->getUsedGeneratedEndpoints();
        //get listed effwords
        $getEffWords = $this->getEffWords();


        header('Content-Type: text/plain');

        //loop
        while(1){
            //create url
            $newEndpoint = $this->generateNewEndpoint();
            //check url.
            //if url is unique, save
            //else loop
        }
        die;

        //reset all the default values
        $this->resetDefaultValues();

        //now that we have our endpoint we need to save it
        $this->store($userSubmittedURL,$newEndpoint );

        //now return the new url to the user. Save as array first
        $URL = ['userURL'=>$userSubmittedURL, 'shortGeneratedURL'=>url('').'/'.$newEndpoint];

        //render the main page with fields
        return view('shortener', ['recentList'=>$this->getRecent10(), 'URL'=>$URL]);
    }
}
