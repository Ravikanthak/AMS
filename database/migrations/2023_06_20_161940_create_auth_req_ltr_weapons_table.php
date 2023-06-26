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
        Schema::create('auth_req_ltr_weapons', function (Blueprint $table) {
            $table->id();
            $table->integer('request_made_by');
            $table->string('incharge', 255);
            $table->string('auth_given_by', 255);
            $table->date('transport_date');
            $table->integer('location_from');
            $table->integer('location_to');
            $table->string('route', 255);
            $table->integer('no_of_wpn');
            $table->string('wpn_details', 255);
            $table->string('type_of_veh', 255);
            $table->string('vehicle_no', 255);
            $table->string('driver', 255);
            $table->string('escort', 255);
            $table->string('escort_weapon_no', 255);
            $table->integer('no_of_magazins');
            $table->integer('no_of_ammo');
            $table->string('ref_of_ltr1', 255);
            $table->string('attachment1', 255)->nullable();
            $table->string('ref_of_ltr2', 255);
            $table->string('attachment2', 255)->nullable();
            $table->integer('req_fwd_by');
            $table->integer('req_fwd_to');
            $table->integer('organization_id');
            $table->integer('user_id');
            $table->string('ip', 255);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auth_req_ltr_weapons');
    }
};
