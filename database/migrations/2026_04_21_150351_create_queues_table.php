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
        Schema::create('queues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');

            $table->foreignId('doctor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('queue_number');
            $table->enum('priority', ['critical', 'urgent', 'normal']);
            $table->enum('status', ['waiting','serving','completed'])->default('waiting'); // waiting, in_progress, completed

            $table->timestamp('called_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queues');
    }
};
