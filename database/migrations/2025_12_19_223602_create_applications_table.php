<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mission_id')->constrained('missions')->cascadeOnDelete();
            $table->foreignId('provider_id')->constrained('users')->cascadeOnDelete();

            $table->decimal('proposed_price', 10, 2)->nullable();
            $table->text('message')->nullable();

            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');

            $table->timestamps();

            $table->unique(['mission_id', 'provider_id']); // un prestataire ne postule qu'une fois
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};