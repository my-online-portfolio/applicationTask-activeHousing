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
        $this->makeEndpoint();//make the new endpoint






        //remove when finished writing
        die("\r\n\r\n\r\n\r\nEOF");        
    }


    //fetch effwords
    //fetch usedwords
    //generate endpoint
    //check new endpoint
    //--IF endpoint is already used. Regenerate
    //--ELSE save the endpoint and return

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    private $effWords = ['urgent','khaki','upwind','augmented','dugout'];
    private $usedWords;

    private function getEffWords(){
        $effWords = $this->multiDimensionalArrayToSingleArray($this->stdClassToArray(DB::table('10effs')->select('words')->get()),'words');
        //$this->effWords = $effWords;
        return;
    }
    private function getUsedWords(){
        $this->usedWords = $this->multiDimensionalArrayToSingleArray($this->stdClassToArray(DB::table('urlshorteners')->select('generated_url')->get()),'generated_url');
        return;
    }
    private function makeEndpoint($effWordChoice = 0,$currentEffWord = null,$totalWordsToInclude = 1){
        
        $effWordsOriginal = array('urgent','khaki','upwind','augmented','dugout');
        $effWords = $effWordsOriginal;
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

            print_r($returnList);
            exit;
            return $returnList;//return the array
        }

        $wordsList = wordsByCount(2,$effWordsOriginal);
       

        /**
         * Now choose a generated word for submission to the check system
         */

        $wordToUse = $wordsList[mt_rand(0,(count($wordsList)-1))];


        print_r($wordToUse);
        die;

    }
    private function checkEndpoint(){}

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    function iterateWords($word = null, $wordList = []){
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
