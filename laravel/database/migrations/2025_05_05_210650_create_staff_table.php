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
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade')->comment('Зовнішній ключ до таблиці users для облікового запису працівника');
            $table->string('position')->nullable()->comment('Посада працівника (наприклад, медсестра, адміністратор)');
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null')->comment('Зовнішній ключ до таблиці departments, до якого належить працівник');
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
