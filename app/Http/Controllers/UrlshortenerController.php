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
    
    public function index()
    {
        //render the main page with fields
        return view('shortener', ['recentList'=>$this->getRecent10()]);
    }
    
    public function create()
    {
        //render the main page with fields
        return view('shortener', ['recentList'=>$this->getRecent10()]);
    }
}
