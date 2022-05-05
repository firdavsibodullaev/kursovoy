<?php

use App\Models\BaseModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScientificResearchEffectivenessUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scientific_research_effectiveness_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scientific_research_effectiveness_id')
                ->constrained('scientific_research_effectivenesses')
                ->cascadeOnDelete();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
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
        Schema::dropIfExists('scientific_research_effectiveness_users');
    }
}
