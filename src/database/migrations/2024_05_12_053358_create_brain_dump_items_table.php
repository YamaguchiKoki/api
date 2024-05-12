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
        Schema::create('brain_dump_items', function (Blueprint $table) {
            $table->id();
            $table->string('dump_id');
            $table->foreign('dump_id')->references('id')->on('brain_dumps')->onDelete('cascade');
            $table->integer('order');
            $table->longText('contents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brain_dump_items');
    }
};
