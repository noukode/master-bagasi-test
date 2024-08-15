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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('desc')->nullable();
            $table->enum('type', ['discount_percentage', 'discount_price'])->default('discount_price');
            $table->string('code')->unique();
            $table->timestamp('tgl_mulai_berlaku');
            $table->timestamp('tgl_akhir_berlaku');
            $table->tinyInteger('is_active')->default(0);
            $table->timestamps();
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
