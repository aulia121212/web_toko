<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Misalnya 'admin' dan 'super_admin'
            $table->timestamps();
        });
    
        // Tambahkan level default
        DB::table('levels')->insert([
            ['name' => 'admin'],
            ['name' => 'super_admin'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('levels');
    }
};
