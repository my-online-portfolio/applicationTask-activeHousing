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
        $this->effWords = $this->stdClassToArray(DB::table('effwords')->get());
        return;
    }
    private function getUsedWords(){}
    private function makeEndpoint(){}
    private function checkEndpoint(){}

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    private function stdClassToArray($stdClass){
        return json_decode($stdClass, true);
    }

}
