<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budget_requests', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email');
            $table->string('contact')->nullable();

            $table->enum('intent', ['duvida', 'orcamento']);

            $table->text('message')->nullable();

            $table->string('project_type')->nullable();
            $table->text('description')->nullable();
            $table->string('deadline')->nullable();
            $table->string('budget')->nullable();

            $table->string('status')->default('novo');
            $table->string('source')->default('site');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budget_requests');
    }
};
