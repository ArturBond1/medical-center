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
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade')->comment('Зовнішній ключ до таблиці users для облікового запису пацієнта');
            $table->string('medical_record_number')->unique()->nullable()->comment('Унікальний номер медичної картки пацієнта');
            $table->date('date_of_birth')->nullable()->comment('Дата народження пацієнта');
            $table->string('gender', 10)->nullable()->comment('Стать пацієнта');
            $table->string('address')->nullable()->comment('Адреса пацієнта');
            $table->string('phone_number', 20)->nullable()->comment('Номер телефону пацієнта');
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
