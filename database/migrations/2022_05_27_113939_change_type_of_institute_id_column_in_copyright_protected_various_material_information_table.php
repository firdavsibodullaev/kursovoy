<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeOfInstituteIdColumnInCopyrightProtectedVariousMaterialInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('copyright_protected_various_material_information', function (Blueprint $table) {
            $table->unsignedBigInteger('institute_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('copyright_protected_various_material_information', function (Blueprint $table) {
            //
        });
    }
}
