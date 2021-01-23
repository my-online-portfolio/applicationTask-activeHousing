<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class UrlshortenerSeeder extends Seeder
{

    private $creationInsert = [];
    private $faker;

    private function createModifyDate($creationDate = null){

        if(is_null($creationDate) || empty($creationDate)){
            die('Cannot fulfil request: '.__FUNCTION__);
        }

        if(rand(0,1)==0){
            //modify the date
            $dateYears = date('Y')-date('Y', strtotime($creationDate));
            $randomYears = rand(1,$dateYears);
            $yearString = '-'.$randomYears.' years';
            $creationDate = $this->faker->dateTimeBetween($startDate = $yearString, $endDate = 'now', $timezone = null);
            $creationDate = $creationDate->format('Y-m-d H:i:s');;
        }

        return $creationDate;
    }

    private function createUrl(){
        $url = 'http://localhost/'.$this->faker->domainWord;

        return $url;
    }

    private function createEntry(){
        
        $this->faker = Faker::create();
        $creationDate = $this->faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null);
        $creationDate = $creationDate->format('Y-m-d H:i:s');
        $modifyDate = $creationDate;

        $newInsert = [
            'user_url' => $this->faker->url,
            'generated_url' => $this->preventDuplicateUrl(),
            'description' => $this->faker->text($maxNbChars = 140) ,
            'date_added' => $creationDate,
           'date_updated' => $this->createModifyDate($creationDate),
        ];
        
        $this->creationInsert[] = $newInsert;

    }

    private function preventDuplicateUrl(){
        $url = $this->createUrl();

        if(!empty($this->creationInsert)){
            for($i=0;$i<count($this->creationInsert);$i++){
               if($this->creationInsert[$i]['generated_url']==$url){
                   print_r('Duplicate found');
                   echo "\r\n";
                    $url = $this->createUrl();
                    $i=0;
               }
            }
        }
        
        return $url;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //truncate the table before seeding
        DB::statement('TRUNCATE urlshorteners');

        //create 30 random entries
    	for($i=1;$i<=30;$i++) {
            $this->createEntry();
        }
        
        DB::table('urlshorteners')->insert($this->creationInsert);
    }
}
