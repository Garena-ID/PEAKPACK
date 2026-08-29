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
    Schema::create('mountains', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('location');
        $table->string('province');
        $table->unsignedInteger('elevation');
        $table->enum('difficulty', ['Easy', 'Medium', 'Hard']);
        $table->string('estimated_duration');
        $table->text('description')->nullable();
        $table->decimal('latitude', 10, 7)->nullable();
        $table->decimal('longitude', 10, 7)->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mountains');
    }
};
