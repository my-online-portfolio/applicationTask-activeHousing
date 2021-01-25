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
        return $this->usedWords = $this->extractFromStdClass($usedWords, 'generated_url');//convert to array and return 
    }

    //get the effwords list from the database
    private function getEffWords(){
        $effWords = DB::table('effwords')->select('words')->get();//database call
        return $this->effWords = $this->extractFromStdClass($effWords, 'words');//convert to array and return 
    }

    private function compareEndPoints($newWord){
        //set the default status to return
        $stopGen = false;//stopGen: set to false to regenerate.

        //refresh the used entry list
        $this->getUsedGeneratedEndpoints();

        //check the the regeneration count isn't more or equal to the usedlist count
        if(count($this->usedWords)>=$this->endpointRegenerateCount){
            //update wordcount to regenerate with increased words
            $stopGen = false;
            $this->endpointWordCount++;

            //reset the regeneration count
            $this->endpointRegenerateCount = 0;
        }

        //return the comparison status
        return $stopGen;
    }

    //generate the endpoint by randomly selecting and concatenating strings of words from a list
    private function generateShortUrl($wordCount = 1){
        //get total amount of words to choose from
        $totalEffWords = count($this->effWords);
        $newEndpoint = null;

            for($i=1;$i<=$wordCount;$i++){
                if(!empty($newEndpoint)){
                    $newEndpoint .= "-";
                }
                $newEndpoint .= $this->effWords[$this->effWordLastUsedKey];
            }

        //increase the generation count
        $this->endpointRegenerateCount++;

        //increment the last used key
        $this->effWordLastUsedKey++;

        return $newEndpoint;
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


        //loop until unique endpoint is made
        while(1){
           $newEndpoint = $this->generateShortUrl($this->endpointWordCount);
           $compareEndpointResult = $this->compareEndPoints($newEndpoint);

           //if comparison returns true, then stop the generator
           if($compareEndpointResult->stopGen===true){
               die('stop loop');
                break;
           }

           break;
        }

        print_r($newEndpoint);
        die;
        $URL = ['userURL'=>$userSubmittedURL, 'shortGeneratedURL'=>$this->generateShortUrl($userSubmittedURL)];

        //render the main page with fields
        return view('shortener', ['recentList'=>$this->getRecent10(), 'URL'=>$URL]);
    }
}
