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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('staff')->onDelete('cascade')->comment('Зовнішній ключ до таблиці staff, ідентифікатор пацієнта');
            $table->foreignId('doctor_id')->constrained('staff')->onDelete('cascade')->comment('Зовнішній ключ до таблиці staff, ідентифікатор лікаря');
            $table->date('appointment_date')->nullable()->comment('Дата прийому');
            $table->time('appointment_time')->nullable()->comment('Час прийому');
            $table->string('reason')->nullable()->comment('Причина звернення на прийом');
            $table->string('status', 20)->default('scheduled')->comment('Статус прийому (заплановано, завершено, скасовано)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
