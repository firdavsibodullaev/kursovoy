<?php

use App\Models\BaseModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOakScientificArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oak_scientific_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->year('publish_year');
            $table->string('pages');
            $table->text('link');
            $table->foreignId('magazine_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('oak_scientific_articles');
    }
}
