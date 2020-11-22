<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCopypastasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copypastas', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->text('body');
            $table->string('title', 100);
            $table->enum('exposure', ['public', 'unlisted', 'private']);
            $table->string('password')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('copypastas');
    }
}
