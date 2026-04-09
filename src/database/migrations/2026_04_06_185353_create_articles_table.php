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
        Schema::create('articles', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('description', 160); // (seo) Мета описание не может быть более 160 символов
            $table->string('canonical_url')->nullable();
            $table->string('ai_summary')->nullable(); // Genarated on save
            $table->text('content');

            $table->foreignUlid('partner_id')
                ->nullable()
                ->index()
                ->constrained('partners')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
