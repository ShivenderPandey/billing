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
    Schema::create('websites', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // owner
        $table->string('name');
        $table->string('domain')->unique();
        $table->decimal('billing_amount', 10, 2)->nullable();
        $table->string('billing_currency', 10)->default('INR');
        $table->string('billing_frequency')->default('yearly'); // monthly/yearly/custom
        $table->date('expiry_date');        // or next_billing_date
        $table->string('status')->default('active'); // active/expired/paused
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('websites');
}

};
