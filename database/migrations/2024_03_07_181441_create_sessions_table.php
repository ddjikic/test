<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id');
            $table->string('browser');
            $table->string('os');
            $table->string('os_version');
            $table->string('cookies');
            $table->string('mobile');
            $table->string('screen');
            $table->string('language',50);
            $table->string('country',2);
            $table->string('city',100);
            $table->ipAddress('ip_address');
            $table->timestamps();
            $table->foreign('website_id')->references('id')->on('websites');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
