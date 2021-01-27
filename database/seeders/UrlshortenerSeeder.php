<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class UrlshortenerSeeder extends Seeder
{

    private $faker;
    private $creationInsert = [];
    private $entries = [
        ['https://github.com','saxophone','NULL',0],
        ['https://www.youtube.com/watch?v=sPHs-c8CvrU','atlas','Who doesn\'t love Thomas?',0],
        ['https://celebrationspress.com/wp-content/uploads/2018/01/010218Goofy.jpg','yogurt','Silly picture',1],
        ['https://osmaps.ordnancesurvey.co.uk/','balancing',NULL,0],
        ['http://www.jayjames.co.uk','detergent',NULL,1],
        ['https://www.google.com','urban','Search Engine',0],
        ['https://www.gocompare.com/ps/homepage/cd/?media=A147135&gclsrc=aw.ds&&gclid=Cj0KCQiAmL-ABhDFARIsAKywVafEdhhrGyrNAr2Ci-VTgIWVioIyLXxv8P9uIm_MfnAxfFbLKSt6nBUaAluWEALw_wcB','cakewalk','That annoying little...',0],
        ['https://miro.com/signup/','guitar','Another test URL',0],
        ['https://www.dogstrust.org.uk/','shirt','A worthwhile cause',0],
        ['https://www.google.com/maps/place/Hereford+Cathedral/@52.0542588,-2.7165856,182m/data=!3m1!1e3!4m5!3m4!1s0x48704a3873b932e3:0xade705243b3ed7fb!8m2!3d52.0543046!4d-2.7158659','john','An old building',0],
        ['https://github.com','fryingpan','This is an entry',1],
        ['https://github.com','blurred','This is the third description',0]

    ];

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

    private function createEntry($entryData){
        $userURL = $entryData[0];
        $generatedURL = $entryData[1];
        $description = $entryData[2];
        $counter = $entryData[3];
        $dateAdded = $this->faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null);

        $entry = [
            'user_url' => $userURL,
            'generated_url' => $generatedURL,
            'description' => $description,
            'counter' => $counter,
            'date_added' => $dateAdded->format('Y-m-d H:i:s')
        ];

        return $entry;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::statement('TRUNCATE urlshorteners');
        $this->faker = Faker::create();

        foreach($this->entries as $nextEntry){
            $this->creationInsert[] = $this->createEntry($nextEntry);
        }

        DB::table('urlshorteners')->insert($this->creationInsert);
    }
}
