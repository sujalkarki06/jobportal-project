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
    Schema::create('companies', function (Blueprint $table) {
        $table->id();
        $table->bigInteger('user_id')->unsigned();
        $table->string('logo')->default('avatar.jpg');
        $table->string('name')->unique();
        $table->string('address');
        $table->string('office_phone')->nullable();
        $table->string('mobile_phone')->nullable();
        $table->text('profile');
        $table->string('URL')->unique()->nullable();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
    
};
