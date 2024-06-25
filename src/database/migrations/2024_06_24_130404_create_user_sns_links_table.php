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
        Schema::create('user_sns_links', function (Blueprint $table) {
          $table->id();
          $table->string('user_id');
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->foreignId('provider_id')->constrained('sns_providers')->onDelete('cascade');
          $table->string('sns_user_id');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('user_sns_links');
    }
};
