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
        

         Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('days');
            $table->decimal('base_price', 10, 2); // Before rates are applied
            $table->timestamps();
        });
        
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->string('rate_name'); // e.g., Standard, Premium
            $table->decimal('multiplier', 5, 2)->default(1.00); // To adjust base price
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->string('from_currency');
            $table->string('to_currency');
            $table->decimal('rate', 10, 4);
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('city');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_package_id');
            $table->date('start_date');
            $table->time('start_time');
            $table->string('duration');
            $table->string('location');
            $table->unsignedBigInteger('rate_id');
            $table->decimal('final_price', 10, 2);
            $table->string('status')->default('available'); // available, fully booked, cancelled
            $table->timestamps();

            $table->foreign('tour_package_id')->references('id')->on('tour_packages')->onDelete('cascade');
            $table->foreign('rate_id')->references('id')->on('rates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('exchange_rates');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('rates');
        Schema::dropIfExists('tour_packages');
    }
};
