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
        Schema::create('salaries', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('basic_salary', 10, 2); // Lương cơ bản
            $table->decimal('allowance', 10, 2); // Phụ cấp
            $table->decimal('social_insurance', 10, 2); // Bảo hiểm xã hội
            $table->decimal('health_insurance', 10, 2); // Bảo hiểm y tế
            $table->decimal('unemployment_insurance', 10, 2); // Bảo hiểm thất nghiệp
            $table->decimal('personal_income_tax', 10, 2); // Thuế thu nhập cá nhân
            $table->decimal('total_salary', 10, 2); // Tổng lương
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
        Schema::dropIfExists('salaries');
    }
};
