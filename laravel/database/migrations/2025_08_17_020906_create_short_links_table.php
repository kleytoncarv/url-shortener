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
        Schema::create('short_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('original_url');
            $table->string('short_code')->unique();
            $table->integer('clicks')->default(0);
<<<<<<< HEAD
            $table->timestamp('expires_at')->nullable(); // corrigido
            $table->timestamps(); // created_at e updated_at
=======
            $table->timestamps('expires_at')->nullable();
            $table->timestamps();
>>>>>>> 05d331ff58c62ba28978dbc8ad511032fe908ad1
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('short_links');
    }
};
