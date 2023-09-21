<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('country');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }
};
