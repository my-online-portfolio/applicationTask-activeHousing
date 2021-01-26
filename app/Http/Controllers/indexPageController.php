<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class indexPageController extends Controller
{
    //get the most recent 10 entries from the database
    private function getRecent10(){
        return DB::table('recentten')->get();//database call and return
    }
    
    public function index(){
        //render the main page with fields
        return view('shortener', ['recentList'=>$this->getRecent10()]);
    }
}
