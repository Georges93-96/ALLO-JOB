<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('type', ['virtual', 'physical']);

            $table->foreignId('service_id')
                ->constrained('services')
                ->cascadeOnDelete();

            $table->string('title', 160);
            $table->text('description');

            $table->decimal('budget', 10, 2)->nullable();

            $table->string('ville', 100)->nullable();
            $table->string('quartier', 150)->nullable();

            $table->enum('status', ['open', 'assigned', 'done', 'cancelled'])
                ->default('open');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};