<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('region_stores', function (Blueprint $table) {
            $table->bigInteger('region_id')->unsigned();
            $table->bigInteger('store_id')->unsigned();

            $table->foreign('region_id')->references('id')->on('regions')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('store_id')->references('id')->on('stores')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('region_stores');
    }
};
