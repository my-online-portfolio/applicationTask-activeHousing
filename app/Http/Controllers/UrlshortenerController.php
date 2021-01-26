<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UrlshortenerController extends Controller
{
    public function create()
    {
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

    private function getEffWords(){}
    private function getUsedWords(){}
    private function makeEndpoint(){}
    private function checkEndpoint(){}

}
