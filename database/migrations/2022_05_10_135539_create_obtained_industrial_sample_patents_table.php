<?php

use App\Models\BaseModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObtainedIndustrialSamplePatentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obtained_industrial_sample_patents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained();
            $table->tinyText('name');
            $table->date('date');
            $table->string('number');
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
        Schema::dropIfExists('obtained_industrial_sample_patents');
    }
}
