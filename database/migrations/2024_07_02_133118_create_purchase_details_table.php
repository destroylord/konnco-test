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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained()
                        ->cascadeOnDelete()
                        ->cascadeOnUpdate();
            $table->foreignId('item_id')->constrained()
                        ->cascadeOnDelete()
                        ->cascadeOnUpdate();
            $table->unsignedInteger('price');
            $table->unsignedInteger('qty');
            $table->unsignedInteger('total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_details');
    }
};
