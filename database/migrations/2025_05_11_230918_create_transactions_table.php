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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Wallet::class);
            $table->decimal('amount', 15, 2);
            $table->string('type'); // 'deposit', 'withdrawal', 'transfer'
            $table->string('status')->default('pending'); // 'pending', 'completed', 'failed'
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['wallet_id', 'type', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
