<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //TODO add nullable columns
        //TODO add default values
        //TODO add trait for image URL and website URL

        Schema::create('vendors', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('name');
            $table->string('type');
            $table->string('power_needs');
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
            $table->string('headliners');
            $table->string('second_headliners');
            $table->string('third_headliners');
            $table->string('image_url');
            $table->string('website_url');
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
            $table->string('address2');
            $table->string('city');
            $table->string('state');
            $table->string('image_url');
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
            $table->string('image_url');
            $table->string('website_url');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events');
            $table->bigInteger('stage_id');
            $table->foreign('stage_id')->references('id')->on('stages');
            $table->string('headliners');
            $table->date('date');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->json('schedule');
            $table->string('image_url');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('artists', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('name');
            $table->string('hometown');
            $table->string('genre');
            $table->string('description');
            $table->json('members');
            $table->string('image_url');
            $table->string('website_url');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('artists_schedules', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('artist_id');
            $table->foreign('artist_id')->references('id')->on('artists');
            $table->bigInteger('schedule_id');
            $table->foreign('schedule_id')->references('id')->on('schedules');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendors_events');
        Schema::dropIfExists('artists_schedules');
        Schema::dropIfExists('vendors_venues');
        Schema::dropIfExists('events_venues');
        Schema::dropIfExists('vendors');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('stages');
        Schema::dropIfExists('venues');
        Schema::dropIfExists('events');
        Schema::dropIfExists('artists');
    }
};
