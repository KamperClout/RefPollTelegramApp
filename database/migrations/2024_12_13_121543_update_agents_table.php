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
        Schema::table('agents', function (Blueprint $table){
            $table->string('tg_id', 300)->default("")->change();
            $table->string('name', 300)->default("")->change();
            $table->string('phone', 15)->default("")->change();
            $table->string('region', 300)->default("")->change();
            $table->boolean('is_qualified')->default(false)->change();
            $table->boolean('is_banned')->default(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
