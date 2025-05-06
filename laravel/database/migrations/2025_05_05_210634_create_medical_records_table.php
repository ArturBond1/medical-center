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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->unique()->constrained('patients')->onDelete('cascade')->comment('Зовнішній ключ до таблиці patients, ідентифікатор пацієнта, для якого ведеться картка');
            $table->text('diagnosis')->nullable()->comment('Попередній або остаточний діагноз');
            $table->text('treatment_plan')->nullable()->comment('План лікування пацієнта');
            $table->text('notes')->nullable()->comment('Додаткові нотатки лікаря щодо стану пацієнта');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
