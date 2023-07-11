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
        Schema::create('auth_req_ltr_weapons_fwds', function (Blueprint $table) {
            $table->id();
            $table->integer('auth_req_ltr_weapons_id');
            $table->integer('req_fwd_by');
            $table->integer('req_fwd_to');
            $table->string('req_fwd_by_status',255);
            $table->string('req_fwd_to_status',255);
            $table->text('comment_approve')->nullable();
            $table->text('comment_decline')->nullable();
            $table->integer('organization_id');
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auth_req_ltr_weapons_fwds');
    }
};
