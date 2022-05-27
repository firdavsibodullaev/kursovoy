<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsConfirmedColumnToObtainedIndustrialSamplePatentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('obtained_industrial_sample_patents', function (Blueprint $table) {
            $table->boolean('is_confirmed')->default(false);
            $table->timestamp('confirmed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('obtained_industrial_sample_patents', function (Blueprint $table) {
            //
        });
    }
}
