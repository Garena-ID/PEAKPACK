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
    Schema::create('rentals', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')
            ->constrained('users')
            ->cascadeOnDelete();

        $table->string('rental_code')->unique();
        $table->date('rental_date');
        $table->date('due_date');
        $table->date('return_date')->nullable();
        $table->decimal('total_price', 12, 2)->default(0);

        $table->enum('status', [
            'Pending',
            'On Rent',
            'Completed'
        ])->default('Pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
