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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->foreignId('contact_id')->constrained('contacts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('newsletter_id')->constrained('newsletters')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['contact_id', 'newsletter_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
