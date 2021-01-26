<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UrlshortenerController extends Controller
{
    public function create()
    {
        header('Content-Type: text/plain');
        $userSubmittedURL = request('urlInput');//capture user submitted url
        $this->getEffWords();//get EffWords
        $this->getUsedWords();//get UsedWords






        //remove when finished writing
        die('EOF');        
    }


    //fetch effwords
    //fetch usedwords
    //generate endpoint
    //check new endpoint
    //--IF endpoint is already used. Regenerate
    //--ELSE save the endpoint and return

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    private $effWords;
    private $usedWords;

    private function getEffWords(){
        $effWords = $this->multiDimensionalArrayToSingleArray($this->stdClassToArray(DB::table('effwords')->select('words')->get()),'words');
        $this->effWords = $effWords;
        return;
    }
    private function getUsedWords(){
        $this->usedWords = $this->multiDimensionalArrayToSingleArray($this->stdClassToArray(DB::table('urlshorteners')->select('generated_url')->get()),'generated_url');
        return;
    }
    private function makeEndpoint(){}
    private function checkEndpoint(){}

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    private function stdClassToArray($stdClass){
        return json_decode($stdClass, true);
    }
    private function multiDimensionalArrayToSingleArray($multiDimensionalArray = [], $key = 0){
        $newArray = [];
        foreach($multiDimensionalArray as $nextRow){
            $newArray[] = $nextRow[$key];
        }
        return $newArray;
    }

}
