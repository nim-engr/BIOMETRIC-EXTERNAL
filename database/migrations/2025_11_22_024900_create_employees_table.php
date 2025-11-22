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
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->string('biometric_number')->unique();

        // employee name
        $table->string('first_name');
        $table->string('middle_initial')->nullable();
        $table->string('family_name');
        $table->string('name_extension')->nullable();
        
        // position and employment status
        $table->string('position')->nullable();
        $table->string('employment_status')->nullable();

        // supervisor name
        $table->string('sup_first_name');
        $table->string('sup_middle_initial')->nullable();
        $table->string('sup_family_name');
        $table->string('sup_name_extension')->nullable();

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
