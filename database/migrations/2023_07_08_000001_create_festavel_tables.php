<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //TODO add default values

        Schema::create('vendors', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('power_needs')->nullable();
            $table->string('hometown')->nullable();
            $table->string('description_short')->nullable();
            $table->string('description_long')->nullable();
            $table->string('address')->nullable();
            $table->string('image_url')->nullable();
            $table->string('website_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('name');
            $table->string('promoter')->nullable();
            $table->string('headliners')->nullable();
            $table->string('second_headliners')->nullable();
            $table->string('third_headliners')->nullable();
            $table->string('image_url')->nullable();
            $table->string('website_url')->nullable();
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
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('image_url')->nullable();
            $table->string('website_url')->nullable();
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
            $table->bigInteger('venue_id')->nullable();
            $table->foreign('venue_id')->references('id')->on('venues');
            $table->string('name')->nullable();
            $table->string('headliners')->nullable();
            $table->string('image_url')->nullable();
            $table->string('website_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events');
            $table->bigInteger('stage_id');
            $table->foreign('stage_id')->references('id')->on('stages');
            $table->string('headliners')->nullable();
            $table->date('date')->nullable();
            $table->datetime('start_time')->nullable();
            $table->datetime('end_time')->nullable();
            $table->json('schedule')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('artists', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('name');
            $table->string('hometown')->nullable();
            $table->string('genre')->nullable();
            $table->string('description')->nullable();
            $table->json('members')->nullable();
            $table->string('image_url')->nullable();
            $table->string('website_url')->nullable();
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
