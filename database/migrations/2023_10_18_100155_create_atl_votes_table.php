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
        Schema::create('atl_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voter_id')->constrained('voters');
            $table->foreignId('election_id')->constrained('elections');
            $table->foreignId('party_id')->constrained('parties');
            $table->integer('priority');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
