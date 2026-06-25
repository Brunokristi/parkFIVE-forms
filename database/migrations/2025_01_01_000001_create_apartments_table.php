<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('label')->nullable();
            $table->string('address');
            $table->string('checkin_time');
            $table->string('checkout_time')->nullable();
            $table->string('access_code');
            $table->string('wifi_name');
            $table->string('wifi_password');
            $table->text('parking_info');
            $table->text('pool_info');
            $table->text('arrival_instructions')->nullable();
            $table->text('key_instructions')->nullable();
            $table->text('quiet_hours')->nullable();
            $table->text('smoking_policy')->nullable();
            $table->text('pets_policy')->nullable();
            $table->text('early_checkin')->nullable();
            $table->json('equipment')->nullable();
            $table->text('trash_info')->nullable();
            $table->text('invoice_info')->nullable();
            $table->text('contact_info');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};