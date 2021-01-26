<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UrlshortenerController extends Controller
{

    public function create()
    {
        $userURL = $generatedURL = $description = null;


        header('Content-Type: text/plain');
        $userURL = 'http://www.google.com';//request('urlInput');//capture user submitted url
        //$description = request('urlInput');//capture user submitted url

        $this->getEffWords();//get EffWords
        $this->getUsedWords();//get UsedWords
        $generatedURL = $this->makeEndpoint();//make the new endpoint

        //store the new endpoint
        $this->store($userURL, $generatedURL, $description);

        //return the output to the page view



        //remove when finished writing
        die("\r\n\r\n\r\n\r\nEOF");        
    }

    /**
     * Function to store the newly created endpoint
     */
    private function store($userURL, $generatedURL, $description = null){
        
        $returnedInfo = DB::table('urlshorteners')->insert([
            'user_url' => $userURL,
            'generated_url' => $generatedURL,
            'description'=> $description,
        ]);

        return $returnedInfo;
    }

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    private $effWords;
    private $usedWords;
    private $totalWordsToInclude = 1;

    private function getEffWords(){
        $this->effWords = $this->multiDimensionalArrayToSingleArray(
            $this->stdClassToArray(
                DB::table('effwords')
                ->select('words')
                ->inRandomOrder()
                ->limit(5)
                ->get()
            ),
            'words'
        );
        return;
    }
    private function getUsedWords(){
        $this->usedWords = $this->multiDimensionalArrayToSingleArray($this->stdClassToArray(DB::table('urlshorteners')->select('generated_url')->get()),'generated_url');
        return;
    }
    private function makeEndpoint($totalWordsToInclude = 1){
        if($this->totalWordsToInclude!=$totalWordsToInclude){
            $this->totalWordsToInclude = $totalWordsToInclude;
        }
        
        $effWords = $this->effWords;
        $wordsList = array();
        $firsWord = $effWords[0];

        /**
         * Function to remove the first element of the array and place
         * it on the end of the array.
         * Will return an array of arrays until the sequence ends up with 
         * the first element back in it's position
         */
        function shiftAround($array = array()){
            //reindex array
            $array = array_values($array);
            $firstArrayElement = $array[0];//capture first element
            $returnArray = array();//array to return later

            while(1){
                $removeElement = $array[0];//capture the first element
                array_shift($array);//remove the first element
                $array[] = $removeElement;//append the element

                //add the array to the returnArray
                $returnArray[] = $array;

                if($array[0]==$firstArrayElement){
                    break;
                }
            }

            return $returnArray;
        }

        /**
         * Function to generate an array of words that can be used
         */
        function wordsByCount($count = 1, $wordsToPickFrom = array()){
            
            $returnList = array();
            $wordSeperator = '-';

            if($count==1){ return $wordsToPickFrom; }//if word count is 1 return wordlist
            else{

                //loop through each word
                foreach($wordsToPickFrom as $nextWord){
                    //loop through iterations on self
                    $self = array();
                    for($a=0;$a<$count;$a++){
                        $self[] = $nextWord;//add self to array
                        $returnList[] = implode('-',$self);//concatenate array elements and insert into array
                    }
                }

                //loop through each entry of the array
                foreach($wordsToPickFrom as $nextWord){
                    //add each word to use sequentially
                    $sequentially = $wordsToPickFrom;//make copy of wordlist
                    //remove self from array
                    $sequentially = array_flip($sequentially);//swap the keys and values
                    unset($sequentially[$nextWord]);//remove from array using the nextword
                    $sequentially = array_flip($sequentially);//swap the keys and values
                    $theOrder = shiftAround($sequentially);//get an array of arrays with changing sequence

                    //loop around each theOrder to get order of words to use
                    foreach($theOrder as $nextList){

                        $nextListToAdd = array();
                        $previousWord = $nextWord;
                        foreach($nextList as $nextWord2){
                            $previousWord = $previousWord.$wordSeperator.$nextWord2;
                            $nextListToAdd[] = $previousWord;
                        }
                        $returnList = array_merge($returnList, $nextListToAdd);
                    }

                }



            }

            //trim the array to entries containing hyphens
            if($count>1){
                $newReturnList = array();
                foreach($returnList as $nextCheck){
                    if((substr_count($nextCheck,$wordSeperator)+1)==$count){
                        $newReturnList[] = $nextCheck;
                    }
                }
                $returnList = $newReturnList;
            }

            sort($returnList);//sort the array in alphabetical order

            return $returnList;//return the array
        }


        while(1){
            $wordsList = wordsByCount($this->totalWordsToInclude,$effWords);
            $wordToUse = $wordsList[mt_rand(0,(count($wordsList)-1))];
            $wordCheck = $this->checkEndpoint($wordToUse, $wordsList);

            //update the lists
            $this->getEffWords();//get EffWords
            $this->getUsedWords();//get UsedWords
            
            if($wordCheck->state === true){
                break;
            }
        }


        return $wordToUse;

    }
    private function checkEndpoint($chosenWord,$endpointsToCheck){
        $status = (object) array('state'=>false);
        $usedWords = $this->usedWords;

        //compare arrays and return differences
        $wordsArray = array_diff($endpointsToCheck, $usedWords);
        if(count($wordsArray)==0){
            //we have no unique words.
            //return and increase the wordcount
            $this->totalWordsToInclude++;
            $status->state = false;
        }
        else{

            //make sure the chosen word isn't in the list
            if(in_array($chosenWord, $wordsArray)){
                $status->state = true;
            }
            else{
                $this->totalWordsToInclude++;
                $status->state = false;
            }

        }

        return $status;
    }

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    private function randomEffWords(){

    }
    private function iterateWords($word = null, $wordList = []){
        $returnWordList = [];
        
        if(!empty($word)){ $word .= '-'; }
        
        for($i=0;$i<=(count($wordList)-1);$i++){
        
            $returnWordList[] = $word.$wordList[$i];
        
        }
        
        return $returnWordList;
    }
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
