<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlshortenersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urlshorteners', function (Blueprint $table) {
            $table->string('uuid', 36);
            $table->text('user_url');
            $table->string('generated_url');
            $table->text('description', 140)->nullable();
            $table->integer('counter')->default(0);
            $table->timestamp('date_added')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();;
            $table->timestamp('date_updated')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable();;


            $table->unique('uuid');
            $table->primary('uuid');
            $table->unique('generated_url');
        });

        //create trigger for new uuid when a row is inserted
        DB::unprepared('CREATE  TRIGGER `activehousing`.`urlshorteners_BEFORE_INSERT` BEFORE INSERT ON `urlshorteners` FOR EACH ROW
            BEGIN
                IF ISNULL(NEW.uuid) THEN
                    SET NEW.uuid = UUID();
                END IF;
            END'
            );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('urlshorteners');
    }
}
