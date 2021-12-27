<?php

use App\Models\BaseModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDScDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_sc_doctors', function (Blueprint $table) {
            $table->id();
            $table->json('user');
            $table->json('diploma')->nullable();
            $table->json('professor_without_science_degree')->nullable();
            $table->string('speciality_name')->nullable();
            $table->json('employment')->nullable();
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
        Schema::dropIfExists('d_sc_doctors');
    }
}
