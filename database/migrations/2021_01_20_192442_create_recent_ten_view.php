<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecentTenView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        //delete the view
        DB::statement('DROP VIEW IF EXISTS recentten');
        DB::statement('CREATE VIEW recentten AS SELECT user_url, generated_url, description, counter FROM urlshorteners ORDER BY date_added DESC LIMIT 10');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //delete the view
        DB::statement('DROP VIEW IF EXISTS recentten');
    }
}
