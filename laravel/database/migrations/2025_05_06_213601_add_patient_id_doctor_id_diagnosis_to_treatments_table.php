<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('treatments', function (Blueprint $table) {
            if (!Schema::hasColumn('treatments', 'patient_id')) {
                $table->unsignedBigInteger('patient_id')->nullable()->after('id');
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            }

            if (!Schema::hasColumn('treatments', 'doctor_id')) {
                $table->unsignedBigInteger('doctor_id')->nullable()->after('patient_id');
                $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            }

            if (!Schema::hasColumn('treatments', 'diagnosis')) {
                $table->string('diagnosis')->nullable()->after('doctor_id');
            }
        });
    }


    public function down(): void
    {
        Schema::table('treatments', function (Blueprint $table) {
            $table->dropForeign(['patient_id']);
            $table->dropForeign(['doctor_id']);
            $table->dropColumn(['patient_id', 'doctor_id', 'diagnosis']);
        });
    }
};
