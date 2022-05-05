<?php

use App\Models\BaseModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScientificResearchEffectivenessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scientific_research_effectivenesses', function (Blueprint $table) {
            $table->id();
            $table->string('specialized_name');
            $table->string('specialized_code');
            $table->string('name');
            $table->string('accepted_report');
            $table->date('accepted_date');
            $table->string('publication_name');
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
        Schema::dropIfExists('scientific_research_effectivenesses');
    }
}
