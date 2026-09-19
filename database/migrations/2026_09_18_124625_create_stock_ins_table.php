<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_ins', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ingredient_id')
                ->constrained('ingredients')
                ->onDelete('cascade');

            $table->decimal('quantity', 10, 2);

            $table->decimal('cost_per_unit', 10, 2)->default(0);

            $table->date('stock_in_date');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_ins');
    }
};
