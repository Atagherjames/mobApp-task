<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key (user ID)
            $table->string('full_name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('contact_number')->nullable();
            $table->enum('role', ['admin', 'user'])->default('user'); 
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
