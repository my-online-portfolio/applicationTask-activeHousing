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

        header('Content-Type: text/plain');
        $recent10 = json_decode($recent10, true);

        function diffOutput($check){
            
            $now = date_create();
            $compare = date_create($check);
            $difference = date_diff($now, $compare);
            $theReturn = "Unknown";

            if($difference->y >= 1){
                //return in years
                if($difference->y > 1){
                    $theReturn = "Added {$difference->y} years ago";
                }
                else{
                    $theReturn = "Added 1 year ago";
                }
            }
            else if($difference->m >= 1){
                //return in months
                    if($difference->m == 1){
                        $theReturn = "Added a month ago";
                    }
                    else{
                        $theReturn = "Added {$difference->m} months ago";
                    }
            }
            else if($difference->d >= 1){
                //return in days
                //calculate weeks
                if(($difference->d % 7 == 0) && ($difference->d >= 7)){
                    $weeks = $difference->d/7;
                    if($weeks>1){
                        $theReturn = "Added a week ago";
                    }
                    else{
                        $theReturn = "Added {$weeks} weeks ago";
                    }
                }
                else{
                    //calculate days
                    if($difference->d > 1){
                        $theReturn = "Added {$difference->d} days ago";
                    }
                    else{
                        $theReturn = "Added a day ago";
                    }
                }
            }
            else if($difference->h >= 1){
                //return in hours
                    if($difference->h > 1){
                        $theReturn = "Added {$difference->h} hours ago";
                    }
                    else{
                        $theReturn = "Added a hour ago";
                    }
            }
            else if($difference->i >= 1){
                //return in minutes
                    if($difference->i > 1){
                        $theReturn = "Added {$difference->i} minutes ago";
                    }
                    else{
                        $theReturn = "Added a minute ago";
                    }
            }
            else{
                $theReturn = "Added a moment ago";
            }

            //has years
            //has months
            //has weeks
            //has days
            //has ours
            //has minutes
            //now
            print_r($theReturn);
            die;
            return $theReturn;
        }

        foreach($recent10 as $nextRow){
           print_r(diffOutput($nextRow['date_added']));
           break;
        }


        die;

    }
    
    public function index(){
        //render the main page with fields
        return view('shortener', ['recentList'=>$this->getRecent10()]);
    }
}
