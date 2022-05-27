<?php

use App\Models\BaseModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCopyrightProtectedVariousMaterialInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copyright_protected_various_material_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained('institutes');
            $table->tinyText('name');
            $table->date('date');
            $table->string('serial');
            $table->timestamps();
            $table->softDeletes(BaseModel::DELETED_AT);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('copyright_protected_various_material_information');
    }
}
