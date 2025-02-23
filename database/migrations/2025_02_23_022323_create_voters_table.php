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
        Schema::create('voters', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('mobile')->unique();
            $table->string('email')->unique();
            $table->text('address');
            $table->string('taluk');
            $table->string('district');
            $table->string('state');
            $table->uuid('registration_id')->unique();
            $table->timestamps();
            $table->softDeletes(); // Enables soft delete
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voters');
    }
};
