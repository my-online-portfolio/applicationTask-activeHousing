<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UrlshortenerController extends Controller
{

    private $effWords = [];
    private $usedWords = [];

    private function resetDefaultValues(){

        $this->effWords = [];
        $this->usedWords = [];

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
        return $this->usedWords = $updatedArray;
    }

    //get the effwords list from the database
    private function getEffWords(){
        $effWords = DB::table('effwords')->select('words')->get();//database call
        return $this->effWords = $this->extractFromStdClass($effWords, 'words');//convert to array and return 
    }
    private function generateNewEndpoint(){
        //generate endpoint
        $newEndpoint = null;
        $wordCount = 1;
        $lastEffWordKey = 0;
        $generateAttemptMax = count($this->effWords)-1;
        $generateAttempCurrent = 0;

        while(1){
            //loop through efsWords
            for($i=0;$i<$wordCount;$i++){
                if($wordCount==1){
                    $newEndpoint = $this->effWords[$lastEffWordKey];
                }
                else{
                    $newEndpoint .= "-".$this->effWords[$lastEffWordKey];
                }
            }


            //check endpoint
            if(!in_array($newEndpoint, $this->usedWords)){
                break;
            }
            else{
                //increment the key until a unique one is found
                if($lastEffWordKey>=(count($this->effWords)-1)){
                    $lastEffWordKey=0;
                }
                else{
                    $lastEffWordKey++;
                }
            }

            if($generateAttempCurrent>=$generateAttemptMax){
                break;
            }
            else{
                $generateAttempCurrent++;
            }
        }
        return $newEndpoint;
        //die;
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////

    
    
    public function index(){
        //render the main page with fields
        return view('shortener', ['recentList'=>$this->getRecent10()]);
    }

    public function store($userSubmittedURL, $newEndpoint){
        $newInsert = [
            'user_url' => $userSubmittedURL,
            'generated_url' => $newEndpoint
        ];
        return DB::table('urlshorteners')->insert($newInsert);
    }

    public function create()
    {

        $newEndpoint = null;

        //capture user submitted url
        $userSubmittedURL = request('urlInput');
        for($i=0;$i<=1297;$i++){
        //get generated endpoints
        $usedGeneratedEndpoints = $this->getUsedGeneratedEndpoints();
        //get listed effwords
        $getEffWords = $this->getEffWords();
        $newEndpoint = $this->generateNewEndpoint();

        //reset all the default values
        $this->resetDefaultValues();

        //now that we have our endpoint we need to save it
        $this->store($userSubmittedURL,$newEndpoint);
        }

        //now return the new url to the user. Save as array first
        $URL = ['userURL'=>$userSubmittedURL, 'shortGeneratedURL'=>url('').'/'.$newEndpoint];

        //render the main page with fields
        return view('shortener', ['recentList'=>$this->getRecent10(), 'URL'=>$URL]);
    }
}
