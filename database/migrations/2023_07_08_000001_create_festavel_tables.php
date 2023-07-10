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
            $table->string('type')->nullable()->default(null);
            $table->string('power_needs')->nullable()->default(null);
            $table->string('hometown')->nullable()->default(null);
            $table->string('description_short')->nullable()->default(null);
            $table->string('description_long')->nullable()->default(null);
            $table->string('address')->nullable()->default(null);
            $table->string('image_url')->nullable()->default(null);
            $table->string('website_url')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('name');
            $table->string('promoter')->nullable()->default(null);
            $table->string('headliners')->nullable()->default(null);
            $table->string('second_headliners')->nullable()->default(null);
            $table->string('third_headliners')->nullable()->default(null);
            $table->string('image_url')->nullable()->default(null);
            $table->string('website_url')->nullable()->default(null);
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
            $table->string('address1')->nullable()->default(null);
            $table->string('address2')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('state')->nullable()->default(null);
            $table->string('image_url')->nullable()->default(null);
            $table->string('website_url')->nullable()->default(null);
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
            $table->bigInteger('venue_id')->nullable()->default(null);
            $table->foreign('venue_id')->references('id')->on('venues');
            $table->string('name')->nullable()->default(null);
            $table->string('headliners')->nullable()->default(null);
            $table->string('image_url')->nullable()->default(null);
            $table->string('website_url')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events');
            $table->bigInteger('stage_id');
            $table->foreign('stage_id')->references('id')->on('stages');
            $table->string('headliners')->nullable()->default(null);
            $table->date('date')->nullable()->default(null);
            $table->datetime('start_time')->nullable()->default(null);
            $table->datetime('end_time')->nullable()->default(null);
            $table->json('schedule')->nullable()->default(null);
            $table->string('image_url')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('artists', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('name');
            $table->string('hometown')->nullable()->default(null);
            $table->string('genre')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->json('members')->nullable()->default(null);
            $table->string('image_url')->nullable()->default(null);
            $table->string('website_url')->nullable()->default(null);
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
