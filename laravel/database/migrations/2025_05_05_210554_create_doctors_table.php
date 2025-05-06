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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade')->comment('Зовнішній ключ до таблиці users для облікового запису лікаря');
            $table->string('specialization')->nullable()->comment('Спеціалізація лікаря');
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null')->comment('Зовнішній ключ до таблиці departments, до якого належить лікар');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
