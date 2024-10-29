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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->foreignIdFor(\App\Models\Group::class)->constrained();
            $table->string('name');
            $table->foreignIdFor(\App\Models\Participant::class, 'amigo_oculto_id')
                ->nullable()
                ->constrained('participants');
            $table->string('password')->nullable();
            $table->text('sugestao_de_presente')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
