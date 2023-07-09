<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('name');
            $table->tinyInteger('sells_food');
            $table->string('power_needed');
            $table->string('hometown');
            $table->string('description_short');
            $table->string('description_long');
            $table->string('address');
            $table->string('image_url');
            $table->string('website_url');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('name');
            $table->string('promoter');
            $table->string('website_url');
            $table->string('headliners');
            $table->string('second_headliners');
            $table->string('third_headliners');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('vendors_events', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->bigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('venues', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('name');
            $table->string('address1');
            $table->string('city');
            $table->string('state');
            $table->string('website_url');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('vendors_venues', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->bigInteger('venue_id');
            $table->foreign('venue_id')->references('id')->on('venues');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('events_venues', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events');
            $table->bigInteger('venue_id');
            $table->foreign('venue_id')->references('id')->on('venues');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('stages', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('venue_id');
            $table->foreign('venue_id')->references('id')->on('venues');
            $table->string('name');
            $table->string('headliners');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events');
            $table->bigInteger('stage_id');
            $table->foreign('stage_id')->references('id')->on('stages');
            $table->string('stage_headliners');
            $table->date('date');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->json('schedule');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bands', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('name');
            $table->string('hometown');
            $table->string('genre');
            $table->string('description');
            $table->json('members');
            $table->string('image');
            $table->string('website_url');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bands_schedules', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('band_id');
            $table->foreign('band_id')->references('id')->on('bands');
            $table->bigInteger('schedule_id');
            $table->foreign('schedule_id')->references('id')->on('schedules');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendors');
        Schema::dropIfExists('events');
        Schema::dropIfExists('vendors_events');
        Schema::dropIfExists('venues');
        Schema::dropIfExists('vendors_venues');
        Schema::dropIfExists('events_venues');
        Schema::dropIfExists('stages');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('bands');
        Schema::dropIfExists('bands_schedules');
    }
};
