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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('zipcode');
            $table->string('street');
            $table->string('number')->nullable();
            $table->string('address');
            $table->string('complement')->nullable();
            $table->string('whatsapp');
            $table->string('email')->nullable();
            $table->float('shipping_fee')->nullable()->default(0)->comment('taxa de envio');
            $table->string('logo')->nullable()->default('logo.png');
            $table->string('favicon')->nullable()->default('favicon.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
