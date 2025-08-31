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
        Schema::create('equipment', function (Blueprint $table) {
            $table->string('equipment_id')->primary();
            $table->unsignedBigInteger('facility_id');
            $table->string('name');
            $table->text('capabilities')->nullable();
            $table->text('description')->nullable();
            $table->string('inventory_code')->nullable();
            $table->enum('usage_domain', ['Electronics', 'Mechanical', 'IoT']);
            $table->enum('support_phase', ['Training', 'Prototyping', 'Testing', 'Commercialization']);
            $table->timestamps();

            $table->foreign('facility_id')
                ->references('id')->on('facilities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
