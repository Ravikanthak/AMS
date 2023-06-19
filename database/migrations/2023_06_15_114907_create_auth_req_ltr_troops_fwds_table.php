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
        Schema::create('auth_req_ltr_troops_fwds', function (Blueprint $table) {
            $table->id();
            $table->integer('auth_req_ltr_troops_id');
            $table->integer('req_fwd_by');
            $table->integer('req_fwd_to');
            $table->string('req_fwd_by_status',255);
            $table->string('req_fwd_to_status',255);
            $table->text('comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auth_req_ltr_troops_fwds');
    }
};
