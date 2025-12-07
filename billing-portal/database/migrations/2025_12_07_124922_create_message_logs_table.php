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
    Schema::create('message_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('website_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('provider')->default('whatsapp_cloud');
        $table->string('template_name')->nullable();
        $table->string('status')->default('queued'); // queued,sent,failed
        $table->string('provider_message_id')->nullable();
        $table->json('response')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('message_logs');
}

};
