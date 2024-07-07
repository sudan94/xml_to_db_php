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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('entity_id')->entity_id(true);
            $table->string('CategoryName')->nullable();
            $table->string('sku')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('shortdesc')->nullable();
            $table->double('price',8,4)->nullable();
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            $table->string('Brand')->nullable();
            $table->integer('Rating')->default(0);
            $table->string('CaffeineType')->nullable();
            $table->integer('Count')->default(0);
            $table->string('Flavored')->nullable();
            $table->string('Seasonal')->nullable();
            $table->string('Instock')->nullable();
            $table->boolean('Facebook')->default(false);
            $table->boolean('IsKCup')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
