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
        Schema::create('offers', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('title');
            $table->enum('type', ['House', 'Apartment', 'Hotel', 'Guesthouse']);
            $table->enum('category', ['luxe','beach','city','traditional','mountain','island','desert','boat','rural'])->nullable();
            $table->string('city');
            $table->string('country');
            $table->enum('region', ['Africa', 'Middle East', 'Europe', 'Americas', 'Asia Pacific'])->nullable();
            $table->string('address');
            $table->string('photo')->nullable();
            $table->string('video')->nullable();
            $table->text('description');
            $table->float('price');
            $table->boolean('approved')->nullable();
            $table->boolean('published')->nullable();
            $table->boolean('available')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
