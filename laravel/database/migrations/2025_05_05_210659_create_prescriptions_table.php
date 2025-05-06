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
            $table->foreignId('appointment_id')->constrained('appointments')->onDelete('cascade')->comment('Зовнішній ключ до таблиці appointments, до якого відноситься призначення');
            $table->foreignId('patient_id')->constrained('staff')->onDelete('cascade')->comment('Зовнішній ключ до таблиці staff, для якого виписано призначення');
            $table->foreignId('doctor_id')->constrained('staff')->onDelete('cascade')->comment('Зовнішній ключ до таблиці staff, який виписав призначення');
            $table->foreignId('medication_id')->constrained('staff')->onDelete('cascade')->comment('Зовнішній ключ до таблиці staff, який було призначено');
            $table->string('dosage')->nullable()->comment('Призначене дозування');
            $table->string('frequency')->nullable()->comment('Частота прийому');
            $table->text('notes')->nullable()->comment('Додаткові інструкції щодо прийому ліків');
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
