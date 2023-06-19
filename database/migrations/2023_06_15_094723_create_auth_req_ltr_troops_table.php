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
        Schema::create('auth_req_ltr_troops', function (Blueprint $table) {
            $table->id();
            $table->string('request_made_by', 255);
            $table->string('reason', 255);
            $table->integer('no_of_troops');
            $table->date('transport_date');
            $table->integer('location_from');
            $table->integer('location_to');
            $table->string('auth_given_by', 255);
            $table->string('route', 255);
            $table->string('type_of_veh', 255);
            $table->integer('no_of_seat');
            $table->string('convoy_comd', 255);
            $table->string('escort', 255);
            $table->string('escort_weapon_no', 255);
            $table->integer('no_of_magazins');
            $table->integer('no_of_ammo');
            $table->string('driver', 255);
            $table->string('measures', 255);
            $table->string('ref_of_ltr', 255);
            $table->string('attachment', 255)->nullable();
            $table->integer('req_fwd_by');
            $table->integer('req_fwd_to');
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
        Schema::dropIfExists('auth_req_ltr_troops');
    }
};
