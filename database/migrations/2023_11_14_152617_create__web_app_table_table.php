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
        Schema::create('webapps', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('originalName', 100);
            $table->string('path',100); 
            $table->string('mimeType',100)->nullable();
            $table->string('user_id', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webapps');
    }
};
