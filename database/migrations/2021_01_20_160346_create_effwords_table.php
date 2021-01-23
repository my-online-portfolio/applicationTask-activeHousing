<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateEffwordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('effwords', function (Blueprint $table) {
            $table->string('uuid', 36);
            $table->string('words',255);


            $table->unique('uuid');
            $table->primary('uuid');
            $table->unique('words');
        });

        DB::unprepared('CREATE  TRIGGER `activehousing`.`effwords_BEFORE_INSERT` BEFORE INSERT ON `effwords` FOR EACH ROW
            BEGIN
                IF ISNULL(NEW.uuid) THEN
                    SET NEW.uuid = UUID();
                END IF;
            END'
            );


            Artisan::call('db:seed', [
                '--class' => effwordsSeeder::class
            ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('effwords');
    }
}
