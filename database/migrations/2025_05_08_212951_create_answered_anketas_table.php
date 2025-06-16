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
        Schema::create('answered_anketas', function (Blueprint $table) {
            $table->id();
            $table->json("answers");
            $table->enum('status', ['Рассмотрение', 'Одобрено', 'Отклонено'])->default('Рассмотрение');
            $table->foreignIdFor(\App\Models\Anketa::class);
            $table->foreignIdFor(\App\Models\Agent::class);
            $table->boolean('is_referral')->default(false);
            $table->timestamps();

            $table->index('anketa_id');
            $table->index('status');
            $table->index('agent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answered_anketas');
    }
};
