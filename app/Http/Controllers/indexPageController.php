<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class indexPageController extends Controller
{
    //get the most recent 10 entries from the database
    private function getRecent10(){
        $recent10 = DB::table('recentten')->get();//database call and return

        return $this->dateCalc($recent10);

    }

    private function dateCalc($recent10){

        $recent10 = json_decode($recent10, true);

        /**
         * Create text output depending on time difference
         */
        function diffOutput($check, $prefix = "Added"){
            
            $now = date_create();
            $compare = date_create($check);
            $difference = date_diff($now, $compare);
            $theReturn = "Unknown";

            if($difference->y >= 1){
                //return in years
                if($difference->y > 1){
                    $theReturn = "{$prefix} {$difference->y} years ago";
                }
                else{
                    $theReturn = "{$prefix} 1 year ago";
                }
            }
            else if($difference->m >= 1){
                //return in months
                    if($difference->m == 1){
                        $theReturn = "{$prefix} a month ago";
                    }
                    else{
                        $theReturn = "{$prefix} {$difference->m} months ago";
                    }
            }
            else if($difference->d >= 1){
                //return in days
                //calculate weeks
                if(($difference->d % 7 == 0) && ($difference->d >= 7)){
                    $weeks = $difference->d/7;
                    if($weeks>1){
                        $theReturn = "{$prefix} a week ago";
                    }
                    else{
                        $theReturn = "{$prefix} {$weeks} weeks ago";
                    }
                }
                else{
                    //calculate days
                    if($difference->d > 1){
                        $theReturn = "{$prefix} {$difference->d} days ago";
                    }
                    else{
                        $theReturn = "{$prefix} a day ago";
                    }
                }
            }
            else if($difference->h >= 1){
                //return in hours
                    if($difference->h > 1){
                        $theReturn = "{$prefix} {$difference->h} hours ago";
                    }
                    else{
                        $theReturn = "{$prefix} a hour ago";
                    }
            }
            else if($difference->i >= 1){
                //return in minutes
                    if($difference->i > 1){
                        $theReturn = "{$prefix} {$difference->i} minutes ago";
                    }
                    else{
                        $theReturn = "{$prefix} a minute ago";
                    }
            }
            else{
                $theReturn = "{$prefix} a moment ago";
            }

            //has years
            //has months
            //has weeks
            //has days
            //has ours
            //has minutes
            //now
            return $theReturn;
        }

        foreach($recent10 as $key=>$nextRow){
            $recent10[$key]['date_added'] = diffOutput($nextRow['date_added']);
            $recent10[$key]['date_updated'] = diffOutput($nextRow['date_updated'], "Updated");
        }

        return(object) $recent10;

    }
    
    public function index(){
        //render the main page with fields

        //$this->tmpOutput();
        return view('shortener', ['recentList'=>$this->getRecent10()]);
    }
}
