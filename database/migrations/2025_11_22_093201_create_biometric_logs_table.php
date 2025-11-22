<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('biometric_logs', function (Blueprint $table) {
            $table->id();
            $table->string('pin'); // biometric number
            $table->dateTime('log_time');
            $table->string('verify_mode')->nullable();
            $table->string('in_out_mode')->nullable();
            $table->string('work_code')->nullable();
            $table->string('reserved')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('biometric_logs');
    }
};
