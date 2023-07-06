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
            $table->id();
            $table->foreignId('host_id')->constrained('hosts')->onDelete('cascade');
            $table->string('title');
            $table->enum('type', ['House', 'Apartment', 'Hotel', 'Guesthouse']);
            $table->enum('category', ['luxe', 'city', 'beach', 'rural', 'mountain', 'island', 'desert', 'traditional',  'boat']);
            $table->string('city');
            $table->string('country');
            $table->enum('region', ['Africa', 'Middle East', 'Europe', 'Americas', 'Asia Pacific'])->nullable();
            $table->string('address');
            $table->text('photos')->nullable();
            $table->text('videos')->nullable();
            $table->text('description');
            $table->float('price');
            $table->decimal('rating', 3, 2)->nullable();
            $table->boolean('approved')->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('available')->default(true);
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
