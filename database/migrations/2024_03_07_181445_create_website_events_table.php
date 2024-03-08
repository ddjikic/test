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
        Schema::create('website_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id');
            $table->unsignedBigInteger('session_id');
            $table->string('url',500);
            $table->string('query',500);
            $table->string('referrer_path',500);
            $table->string('referrer_query',500);
            $table->string('referrer_domain',500);
            $table->string('title',500);
            $table->string('event_type',500);
            $table->string('event_name',500);
            $table->timestamps();
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->foreign('website_id')->references('id')->on('websites');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_events');
    }
};
