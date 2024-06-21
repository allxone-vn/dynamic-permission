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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('address');
            $table->string('phone_number');
            $table->string('marital_status');
            $table->decimal('salary', 10, 2);
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')->on('users') 
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
