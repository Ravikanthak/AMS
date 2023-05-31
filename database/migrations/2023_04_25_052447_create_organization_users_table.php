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
        Schema::create('organization_users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('organization_id');
            $table->string('full_name');
            $table->string('gender')->nullable();
            $table->string('is_active_service');
            $table->string('e_number');
            $table->string('service_no');
            $table->string('rank')->nullable();
            $table->string('regiment')->nullable();
            $table->string('unit')->nullable();
            $table->string('nic')->nullable();
            $table->string('is_active_account');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_users');
    }
};
